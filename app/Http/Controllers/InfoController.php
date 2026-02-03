<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;

class InfoController extends Controller
{
    public function contact() {
        // Memanggil file ContactMessage.php
        return view('contactmessage'); 
    }

    public function location() {
        // Memanggil file Location-index.php
        return view('location-index'); 
    }

    public function storeContact(Request $request) {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        ContactMessage::create($validated);

        return back()->with('success', 'Your inquiry has been received by our concierge.');
    }
}