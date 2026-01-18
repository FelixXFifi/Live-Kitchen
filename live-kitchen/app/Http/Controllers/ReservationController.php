<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservationController extends Controller
{ 
    public function index()
    {
        return view('reservation');
    }


    public function store(Request $request)
    {
        try {
            $validated = $request->validate([ 
                'name' => 'required|string|max:255',
                'date' => 'required|date',
                'time' => 'required',
                'occasion' => 'required|string',
                'location' => 'required|string',
                'notes' => 'nullable|string|max:1000',
                'activities_data' => 'required', 
            ], [
                'name.required' => 'Nama wajib diisi.',
                'date.required' => 'Pilih tanggal.',
                'time.required' => 'Pilih waktu.',
                'occasion.required' => 'Pilih jenis acara.',
                'location.required' => 'Lokasi wajib diisi.',
                'activities_data.required' => 'Mohon tambahkan minimal satu aktivitas.',
            ]);

            
            return response()->json([
                'success' => true,
                'message' => 'Reservasi Berhasil!'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan pada input.',
                'errors' => $e->errors()
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => 'Reservasi Berhasil!'
        ]);
    }
}