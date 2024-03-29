<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coureur extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom_conducteur',
        'marque',
        'matricule',
        'image',
        'sponsors',
        'logo-A',
        'wialon_driver_id',


    ];


}
