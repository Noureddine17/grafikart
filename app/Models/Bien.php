<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bien extends Model
{
    //
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
}
