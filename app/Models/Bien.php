<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use HasFactory\Database\Factories\BienFactory;
   


class Bien extends Model

{

    /** @use HasFactory<\Database\Factories\BienFactory> */
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
        'options',
        'images',
        'vendue',
        'chambre',
    ];

    protected $casts = [
        'vendue' => 'boolean',
    ];
}
