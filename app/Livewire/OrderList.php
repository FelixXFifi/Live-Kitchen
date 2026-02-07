<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderList extends Component
{
    use WithPagination;

    // Properti untuk kontrol filter dan sorting
    public $sortDirection = 'desc'; // Default: Terbaru (Z-A)
    public $statusFilter = '';

    // Reset halaman saat filter berubah agar tidak error 'page not found'
    public function updatedSortDirection() { $this->resetPage(); }
    public function updatedStatusFilter() { $this->resetPage(); }

    /**
     * Menghapus semua filter dan mengembalikan ke urutan default
     */
    public function resetFilters()
    {
        $this->reset(['sortDirection', 'statusFilter']);
        $this->resetPage();
    }

    public function render()
    {
        // 1. Cek keberadaan tabel untuk menghindari SQL Error saat migrasi belum dijalankan
        if (!Schema::hasTable('orders')) {
            return view('livewire.order-list', [
                'orders' => new LengthAwarePaginator([], 0, 10),
            ]);
        }

        // 2. Query utama dengan filter status dan pengurutan kronologis dinamis
        $orders = Order::query()
            ->when($this->statusFilter, function($query) {
                $query->where('status', $this->statusFilter);
            })
            ->orderBy('date', $this->sortDirection) // Menggunakan variabel sortDirection (asc/desc)
            ->paginate(10); 

        return view('Admin.order-list', [
        'orders' => $orders
        ])->layout('components.layouts.app');
    }
}