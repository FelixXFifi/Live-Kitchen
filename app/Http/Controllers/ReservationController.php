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

    public function store(Request $request){
    try {
            $data = $request->validate([
                'name'            => 'required|string|max:255',
                'date'            => 'required|date',
                'time'            => 'required',
                'occasion'        => 'required|string',
                'location'        => 'required|string',
                'notes'           => 'nullable|string|max:1000',
                'activities_data' => 'required', 
            ]);

            // 1. Simpan ke Database
            $reservation = Reservation::create($data);

            // 2. Decode JSON activities agar menjadi array PHP
            $items = json_decode($request->activities_data, true);

            // 3. Simpan ID dan Items ke Session secara spesifik
            session([
                'latest_res_id' => $reservation->id,
                'latest_items'  => $items
            ]);

            session()->forget('cart');

            return response()->json([
                'success'      => true,
                'redirect_url' => route('order.summary')
            ]);

        } catch (ValidationException $e) {
            return response()->json(['success' => false, 'errors' => $e->errors()], 422);
        }
    }
}