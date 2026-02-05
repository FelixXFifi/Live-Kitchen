<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'contact_messages';

    // Kolom yang boleh diisi melalui form
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
    ];
}