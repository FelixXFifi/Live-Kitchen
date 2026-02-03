<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'date', 
        'time', 
        'occasion', 
        'location', 
        'notes', 
        'activities_data' // Penting untuk menyimpan rincian item
    ];

    // Otomatis convert JSON ke Array saat diakses di Order Summary
    protected $casts = [
        'activities_data' => 'array',
    ];
}