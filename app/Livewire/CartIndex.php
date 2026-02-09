<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Menu;

class CartIndex extends Component
{
    public $cart = [];
    public $total = 0;

    public function mount()
    {
        // Mengambil data dari session 'cart'. Jika kosong, set jadi array kosong.
        $this->cart = session()->get('cart', []);
        $this->curateTotal();
    }

    public function removeItem($id)
    {
        $this->cart = array_filter($this->cart, fn($item) => $item['id'] !== $id);
        $this->cart = array_values($this->cart);
        session()->put('cart', $this->cart);
        $this->curateTotal();
    }

    public function increment($id)
    {
        foreach ($this->cart as &$item) {
            if ($item['id'] === $id) {
                $item['qty']++;
            }
        }
        session()->put('cart', $this->cart);
        $this->curateTotal();
    }

    public function decrement($id)
    {
        foreach ($this->cart as &$item) {
            if ($item['id'] === $id && $item['qty'] > 1) {
                $item['qty']--;
            }
        }
        session()->put('cart', $this->cart);
        $this->curateTotal();
    }

    public function curateTotal()
    {
        $this->total = collect($this->cart)->sum(fn($item) => $item['price'] * $item['qty']);
    }

    public function checkout()
    {
        if (empty($this->cart)) {
            return;
        }

        // 1. CEK APAKAH USER SUDAH LOGIN
        if (!auth()->check()) {
            // Jika belum login, kirim sinyal ke AlpineJS di Blade untuk buka modal
            // Pastikan nama event 'open-auth-modal' sama dengan yang ada di x-on di Blade
            $this->dispatch('open-auth-modal');
            return;
        }

        // 2. JIKA SUDAH LOGIN, SIMPAN DATA KE SESSION & TERBANG KE RESERVASI
        session([
            'cart_items' => $this->cart, 
            'grand_total' => $this->total
        ]);

        return redirect()->route('reservation.index');
    }

    public function render()
    {
        return view('livewire.cart-index')->layout('layouts.app');
    }
}