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
        // Filter array untuk menghapus item
        $this->cart = array_filter($this->cart, fn($item) => $item['id'] !== $id);

        // Reset index array agar tetap berurutan
        $this->cart = array_values($this->cart);

        // Update session agar data yang dihapus tersimpan
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
            session()->flash('error', 'Keranjang Anda masih kosong.');
            return;
        }

        // Simpan data cart final ke session untuk halaman reservasi
        session(['cart_items' => $this->cart, 'grand_total' => $this->total]);

        return redirect()->route('reservation.index');
    }

    public function render()
    {
        return view('livewire.cart-index')->layout('layouts.app');
    }
}
