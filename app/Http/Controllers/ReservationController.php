<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;

class ReservationController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $cartTotal = 0;
        foreach ($cart as $details) {
            $cartTotal += ($details['price'] ?? 0) * ($details['qty'] ?? 0);
        }
        return view('reservation', compact('cart', 'cartTotal'));
    }

    public function summary()
    {
        return view('order-summary-page'); 
    }

    // ReservationController.php

// ReservationController.php
public function store(Request $request) {
    try {
        $data = $request->validate([
            'name'            => 'required|string|max:255',
            'date'            => 'required|date',
            'time'            => 'required',
            'occasion'        => 'required|string', // Pastikan input ini ada di form
            'location'        => 'required|string',
            'notes'           => 'nullable|string|max:1000',
            'activities_data' => 'required', 
        ]);

        // Simpan ke database
        $reservation = Reservation::create($data);

        // Simpan ke session agar OrderSummary bisa membaca datanya
        session([
            'latest_res_id' => $reservation->id,
            'latest_items'  => json_decode($request->activities_data, true)
        ]);

        return response()->json([
            'success'      => true,
            'redirect_url' => route('order.summary')
        ]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
    }
}
}