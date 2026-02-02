<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use App\Models\Reservation;

class OrderSummary extends Component
{
    public $reservation;
    public $items;

 public function mount()
{
    // Ambil ID dari session pesanan terakhir
    $resId = session('latest_res_id');
    $this->items = session('latest_items', []);

    // Ambil data database berdasarkan ID tersebut
    $dbData = $resId ? Reservation::find($resId) : Reservation::latest()->first();

    if ($dbData) {
        $this->reservation = [
            'name'         => $dbData->name,
            'date'         => $dbData->date,
            'commencement' => $dbData->time,
            'occasion'     => $dbData->occasion,
            'location'     => $dbData->location,
        ];
    }
}

public function render()
{
    // Hitung total dengan dukungan key 'qty' atau 'quantity' agar tidak error
    $subtotal = collect($this->items)->sum(function($item) {
        return ($item['qty'] ?? $item['quantity'] ?? 1) * ($item['price'] ?? 0);
    });

    $servicePremium = $subtotal * 0.05;

    return view('livewire.order-summary', [
        'subtotal'       => $subtotal,
        'servicePremium' => $servicePremium,
        'totalBalance'   => $subtotal + $servicePremium,
        'totalVolume'    => collect($this->items)->sum(fn($i) => $i['qty'] ?? $i['quantity'] ?? 1)
    ]);
}
}