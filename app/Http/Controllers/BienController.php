<?php

namespace App\Http\Controllers;

use App\Mail\BienContactMail;
use App\Models\Bien;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Bien::query()->with('featureOptions:id,name');

        $options = Option::query()->orderBy('name')->get();
        $selectedOptions = collect($request->input('options', []))
            ->filter(fn($optionId) => filled($optionId))
            ->map(fn($optionId) => (int) $optionId)
            ->values()
            ->all();

        $cleanSearch = str_replace(' ', '', $request->input('prix_max', ''));

        if ($request->filled('surface_min')) {
            $query->where('surface', '>=', $request->input('surface_min'));
        }
        if ($request->filled('pieces_min')) {
            $query->where('pieces', '>=', $request->input('pieces_min'));
        }
        if ($request->filled('prix_max')) {
            $query->where('prix', '<=', $cleanSearch);
        }
        if ($request->filled('mots-clef')) {
            $mot = '%' . $request->input('mots-clef') . '%';
            $query->whereAny(['title', 'description', 'address', 'ville', 'code_postal', 'etage', 'chambre', 'etage'], 'like', $mot);
        }
        if ($selectedOptions !== []) {
            $query->whereHas('featureOptions', function ($relationQuery) use ($selectedOptions) {
                $relationQuery->whereIn('options.id', $selectedOptions);
            });
        }


        $biens = $query->paginate(9)->appends($request->query());

        confirmDelete('Supprimer ce bien ?', 'Cette action est irreversible.');

        return view('biens.bien', [
            'biens' => $biens,
            'options' => $options,
            'selectedOptions' => $selectedOptions,
        ]);
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
        return view('biens.createbien', [
            'options' => Option::query()->orderBy('name')->get(),
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
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
            'options' => 'nullable|array',
            'options.*' => 'integer|exists:options,id',
            'images' => 'required|image|max:50000', // 50mb max
            'chambre' => 'nullable|string',

        ]);

        $imagePath = $request->file('images')->store('biens', 'public');
        $validatedData['images'] = $imagePath;

        $validatedData['vendue'] = false;

        if (empty($validatedData['etage'])) {
            $validatedData['etage'] = 0;
        }

        $selectedOptions = $validatedData['options'] ?? [];
        unset($validatedData['options']);

        $bien = Bien::create($validatedData);
        $bien->featureOptions()->sync($selectedOptions);

        return redirect('biens')->with('success', 'Le bien a été ajouté avec succès !');
    }




    /**
     * Display the specified resource.
     */
    public function show(Bien $bien)
    {
        $bien->load('featureOptions:id,name');

        return view('biens.showbien', ['bien' => $bien]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bien $bien)
    {
        $bien->load('featureOptions');

        return view('biens.editbien', [
            'bien' => $bien,
            'options' => Option::query()->orderBy('name')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bien $bien)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'surface' => 'required|string',
            'prix' => 'required|string',
            'description' => 'required|string',
            'pieces' => 'required|integer|min:1',
            'etage' => 'nullable|integer',
            'address' => 'required|string',
            'ville' => 'required|string',
            'code_postal' => 'required|string',
            'options' => 'nullable|array',
            'options.*' => 'integer|exists:options,id',
            'images' => 'nullable|image|max:50000',
            'chambre' => 'nullable|string',
        ]);

        $data = $validatedData;
        unset($data['images'], $data['options']);
        $data['vendue'] = $request->boolean('vendue');
        $bien->fill($data);

        $imagePath = $request->file('images');
        if ($imagePath) {
            $imagePath = $imagePath->store('biens', 'public');
            $bien->images = $imagePath;
        }

        $bien->save();
        $bien->featureOptions()->sync($validatedData['options'] ?? []);

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
        ], [
            'msg.required' => 'Le message est obligatoire.',
            'msg.min' => 'Le message doit contenir au moins 10 caractères.',
            'msg.max' => 'Le message ne doit pas dépasser 2000 caractères.',
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
