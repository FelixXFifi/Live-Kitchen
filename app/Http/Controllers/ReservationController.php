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
    /**
     * Menampilkan halaman reservasi dan keranjang
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $cartTotal = 0;
        foreach ($cart as $details) {
            $cartTotal += ($details['price'] ?? 0) * ($details['qty'] ?? 0);
        }
        return view('reservation', compact('cart', 'cartTotal'));
    }

    /**
     * Menampilkan nota/ringkasan pesanan setelah pembayaran/simpan
     */
    public function summary()
    {
        // 1. Ambil data dari session yang disimpan saat fungsi store()
        $resId = session('latest_res_id');
        $snapToken = session('snap_token');

        // Jika tidak ada ID reservasi, kembalikan ke halaman awal
        if (!$resId) {
            return redirect()->route('reservation.index');
        }

        // 2. Ambil data asli dari Database berdasarkan ID
        $reservation = Reservation::find($resId);
        $items = session('latest_items', []);

        if (!$reservation) {
            return redirect()->route('reservation.index')->with('error', 'Data tidak ditemukan.');
        }

        // 3. Logika perhitungan untuk Nota
        $subtotal = 0;
        $totalVolume = 0;
        if (is_array($items)) {
            foreach ($items as $item) {
                $subtotal += (($item['price'] ?? 0) * ($item['qty'] ?? 1));
                $totalVolume += ($item['qty'] ?? 1);
            }
        }

        $servicePremium = $subtotal * 0.05; // Pajak/Layanan 5%
        $totalBalance = $subtotal + $servicePremium;

        // 4. Menentukan keterangan status pembayaran
        $paymentMethod = $snapToken ? 'Midtrans Secure Payment' : 'Manual Payment / Pending';

        // 5. Kirim data ke view
        return view('order-summary-page', compact(
            'reservation', 
            'items', 
            'subtotal', 
            'totalVolume', 
            'servicePremium', 
            'totalBalance',
            'paymentMethod'
        ));
    }

    /**
     * Menyimpan data reservasi dan mendapatkan token Midtrans
     */
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

            // 3. Hitung Total Harga untuk Midtrans
            $totalAmount = 0;
            if (is_array($items)) {
                foreach ($items as $item) {
                    $totalAmount += ($item['price'] * $item['qty']);
                }
            }
            
            // Tambahkan biaya layanan ke total Midtrans agar sinkron dengan nota
            $totalWithService = $totalAmount + ($totalAmount * 0.05);

            // 4. Konfigurasi Midtrans
            Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
            Config::$isSanitized = true;
            Config::$is3ds = true;

            // 5. Buat Parameter Transaksi
            $params = [
                'transaction_details' => [
                    'order_id'     => 'RES-' . $reservation->id . '-' . time(),
                    'gross_amount' => (int)$totalWithService,
                ],
                'customer_details' => [
                    'first_name' => $request->name,
                ],
            ];

            // 6. Dapatkan Snap Token
            $snapToken = Snap::getSnapToken($params);

            // 7. Simpan data penting ke session agar bisa dibaca di halaman summary
            session([
                'latest_res_id' => $reservation->id,
                'latest_items'  => $items,
                'snap_token'    => $snapToken
            ]);

            // 8. Respon JSON untuk ditangkap JavaScript (SweetAlert/Snap Pop-up)
            return response()->json([
                'success'      => true,
                'snap_token'   => $snapToken,
                'redirect_url' => route('order.summary')
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}