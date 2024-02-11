<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ressource extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_rapport_temps_reel',
        'id_rapport_temps_final',
        'id_rapport_final',
        'id_lap1',
        'id_lap2',
        'course_id'
    ];

}
