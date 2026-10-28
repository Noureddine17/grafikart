<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Bien extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'surface',
        'prix',
        'description',
        'pieces',
        'etage',
        'address',
        'ville',
        'code_postal',
        'images',
        'vendue',
        'chambre',
    ];
    
    public function featureOptions(): BelongsToMany
    {
        return $this->belongsToMany(Option::class, 'biens_options', 'bien_id', 'option_id');
    }

    protected $casts = [
        'vendue' => 'boolean',
    ];
}
