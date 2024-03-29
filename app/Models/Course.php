<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'start_point',
        'end_point',
        'start_time',
        'end_time',
        'starting_kilometer',
        'ending_kilometer',
        'wialon_driver_id',
    ];



}
