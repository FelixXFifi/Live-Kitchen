<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    // Masukkan ke dalam sini
    protected $fillable = [
        'name', 
        'date', 
        'time', 
        'occasion', 
        'location', 
        'notes', 
        'activities_data'
    ];
}