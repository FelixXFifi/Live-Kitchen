<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;

class OrderDetail extends Component
{
    public $order;

    public function mount($id)
{
    try {
        // Coba cari di database jika tabel sudah ada
        $this->order = Order::find($id);
    } catch (\Exception $e) {
        $this->order = null;
    }

    // Jika data tidak ditemukan atau tabel belum ada, gunakan Dummy Data untuk Preview
    if (!$this->order) {
        $this->order = (object) [
            'id' => 1,
            'customer_name' => 'Alexander Raymond',
            'date' => now(),
            'occasion_type' => 'Gala Dinner Exclusive',
            'commencement_time' => '19:00 PM',
            'location' => 'The Grand Ballroom, Ritz-Carlton',
            'total_items' => 12,
            'total_volume' => 'High Volume (Bespoke)',
            'subtotal' => 25000000,
            'status' => 'In Production',
            'payment_status' => 'Paid'
        ];
    }
}

    public function render()
    {
        $subtotal = $this->order->subtotal ?? 0;
        $premium = $subtotal * 0.05;
        $totalBalance = $subtotal + $premium;

        return view('livewire.order-detail', [
            'bespokePremium' => $premium,
            'totalBalance' => $totalBalance
        ]);
    }
}