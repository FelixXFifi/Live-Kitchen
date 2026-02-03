<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use App\Models\Reservation;

class OrderSummary extends Component
{
    public $reservation;
    public $items;

 // App\Livewire\OrderSummary.php

// OrderSummary.php
public function mount()
{
    $resId = session('latest_res_id');
    $this->items = session('latest_items', []);

    // Gunakan find() hanya jika ID tersedia
    $dbData = $resId ? Reservation::find($resId) : null;

    if ($dbData) {
        $this->reservation = [
            'name'         => $dbData->name,
            'date'         => $dbData->date,
            'commencement' => $dbData->time,
            'occasion'     => $dbData->occasion,
            'location'     => $dbData->location,
        ];
    } else {
        // Jika tidak ada data, arahkan kembali ke menu/cart
        return redirect()->route('cart.index');
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