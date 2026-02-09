<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Exception;
use Midtrans\Config;
use Midtrans\Snap;

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
        // Pastikan view ini sesuai dengan nama file blade kamu
        return view('order-summary-page'); 
    }

    public function store(Request $request) 
    {
        try {
            // 1. Validasi Input
            $validator = Validator::make($request->all(), [
                'name'            => 'required|string|max:255',
                'date'            => 'required|date',
                'time'            => 'required',
                'occasion'        => 'required|string',
                'location'        => 'required|string',
                'notes'           => 'nullable|string|max:1000',
                'activities_data' => 'required', 
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Lengkapi semua form yang tersedia!',
                    'errors'  => $validator->errors()
                ], 422);
            }

            // 2. Simpan ke Database
            $reservation = Reservation::create($validator->validated());
            $items = json_decode($request->activities_data, true);

            // 3. Hitung Total Harga dari activities_data
            $totalAmount = 0;
            if (is_array($items)) {
                foreach ($items as $item) {
                    $totalAmount += ($item['price'] * $item['qty']);
                }
            }

            // 4. Konfigurasi Midtrans
            Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
            Config::$isSanitized = true;
            Config::$is3ds = true;

            // 5. Buat Parameter Transaksi
            $params = [
                'transaction_details' => [
                    'order_id'     => 'RES-' . $reservation->id . '-' . time(),
                    'gross_amount' => (int)$totalAmount,
                ],
                'customer_details' => [
                    'first_name' => $request->name,
                ],
                // Opsional: tambahkan item_details agar di struk Midtrans terlihat detailnya
            ];

            // 6. Dapatkan Snap Token
            $snapToken = Snap::getSnapToken($params);

            // Simpan ke session agar bisa dipakai di halaman summary
            session([
                'latest_res_id' => $reservation->id,
                'latest_items'  => $items,
                'snap_token'    => $snapToken
            ]);

            // 7. Respon JSON untuk ditangkap JavaScript
            return response()->json([
                'success'      => true,
                'snap_token'   => $snapToken,
                'redirect_url' => route('order.summary') // Pastikan route ini ada di web.php
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}