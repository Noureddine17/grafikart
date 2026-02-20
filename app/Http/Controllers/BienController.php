<?php

namespace App\Http\Controllers;

use App\Mail\BienContactMail;
use App\Models\Bien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;



class BienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Bien::query();

        if ($request->filled('surface_min')) {
            $query->where('surface', '>=', $request->input('surface_min'));
        }
        if ($request->filled('pieces_min')) {
            $query->where('pieces', '>=', $request->input('pieces_min'));
        }
        if ($request->filled('prix_max')) {
            $query->where('prix', '<=', $request->input('prix_max'));
        }
        if ($request->filled('mots-clef')) {
            $mot = '%' . $request->input('mots-clef') . '%';
            $query->whereAny(['title', 'description', 'options', 'address', 'ville', 'code_postal', 'etage', 'chambre', 'etage'], 'like', $mot);
        }


        $biens = $query->paginate(9);

        return view('biens.bien', ['biens' => $biens]);
    }


    public function Home()
    {
        return view('welcome', ['biens' => Bien::latest()->take(3)->get()]);
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('biens.bien', ['success' => 'Le bien a été ajouté avec succès !']);
    }




    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // 1. Validation des données
        // On s'assure que les données reçues respectent tes critères
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'surface' => 'required|string|',
            'prix' => 'required|string|',
            'description' => 'required|string',
            'pieces' => 'required|integer|min:1',
            'etage' => 'nullable|integer',
            'address' => 'required|string',
            'ville' => 'required|string',
            'code_postal' => 'required|string',
            'options' => 'nullable|string',
            'images' => 'required|image|max:50000', // 50mb max
            'chambre' => 'nullable|string',

        ]);

        // 2. Traitement de l'image
        // La méthode store() enregistre le fichier sur le disque 'public' dans le dossier 'biens'
        // Elle retourne le chemin du fichier (ex: "biens/monimage.jpg")
        $imagePath = $request->file('images')->store('biens', 'public');

        // 3. Préparation des données pour la base de données
        // Dans $validatedData, 'images' est encore l'objet fichier.
        // On le remplace par le chemin (string) pour que la base de données l'accepte.
        $validatedData['images'] = $imagePath;

        $validatedData['vendue'] = false;

        if (empty($validatedData['options'])) {
            $validatedData['options'] = '';
        }

        if (empty($validatedData['etage'])) {
            $validatedData['etage'] = 0;
        }


        // 4. Enregistrement
        // On utilise les données validées (avec le chemin de l'image corrigé) pour créer le Bien
        $bien = Bien::create($validatedData);

        // 5. Redirection
        // On redirige l'utilisateur vers la liste des biens (ou ailleurs) avec un message
        return redirect('biens')->with('success', 'Le bien a été ajouté avec succès !');
    }




    /**
     * Display the specified resource.
     */
    public function show(Bien $bien)
    {
        $bien = Bien::query()->where('id', $bien->id)->first();


        return view('biens.showbien', ['bien' => $bien]);


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bien $bien)
    {
        return view('biens.editbien', ['bien' => $bien]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bien $bien)
    {
        $data = $request->except('images');
        $data['vendue'] = $request->boolean('vendue');
        $bien->fill($data);

        $imagePath = $request->file('images');
        if ($imagePath) {
            $imagePath = $imagePath->store('biens', 'public');
            $bien->images = $imagePath;
        }

        $bien->save();

        return redirect()->route('biens.index')->with('success', 'Le bien a été mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bien $bien)
    {
        $bien->delete();

        return redirect()->route('biens.index')->with('success', 'Le bien a été supprimé avec succès !');
    }

    public function contact(Request $request, Bien $bien)
    {
        $validatedData = $request->validate([
            'prenom' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'tel' => 'required|string|max:30',
            'email' => 'required|email|max:255',
            'msg' => 'required|string|min:10|max:2000',
        ]);

        $to = config('mail.to.address');
        if (empty($to)) {
            return redirect()
                ->route('biens.show', $bien)
                ->withInput()
                ->with('error', "L'adresse email de l'agence n'est pas configurée.");
        }

        $payload = [
            'prenom' => $validatedData['prenom'],
            'name' => $validatedData['name'],
            'tel' => $validatedData['tel'],
            'email' => $validatedData['email'],
            'msg' => trim($validatedData['msg']),
            'bien_id' => $bien->id,
            'bien_title' => $bien->title,
            'bien_prix' => $bien->prix,
            'bien_url' => route('biens.show', $bien),
        ];

        try {
            Mail::to($to)->send(new BienContactMail($payload));
        } catch (\Throwable $exception) {
            report($exception);

            return redirect()
                ->route('biens.show', $bien)
                ->withInput()
                ->with('error', "L'envoi du message a échoué. Réessaie dans quelques instants.");
        }

        return redirect()
            ->route('biens.show', $bien)
            ->with('success', 'Votre message a été envoyé avec succès.');
    }


}
