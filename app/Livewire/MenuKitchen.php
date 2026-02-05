<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Menu;

class MenuKitchen extends Component
{
    public $search = '';
    public $showModal = false;
    public $selectedMenu;

    /**
     * Triggered when a menu item is selected to show the detail modal
     */
    public function selectMenu($menuId)
    {
        $this->selectedMenu = Menu::find($menuId);
        $this->showModal = true;
    }

    /**
     * Closes the detail modal
     */
    public function closeModal()
    {
        $this->showModal = false;
    }

    /**
     * Logic to save the item to the session cart and trigger animation
     */
    public function addToCart()
    {
        if (!$this->selectedMenu) {
            return;
        }

        // 1. Get current cart from session
        $cart = session()->get('cart', []);

        // 2. Check if product already exists in the cart
        $found = false;
        foreach ($cart as &$item) {
            if ($item['id'] === $this->selectedMenu->id) {
                $item['qty']++;
                $found = true;
                break;
            }
        }

        // 3. If item is new, add it to the array
        if (!$found) {
            $cart[] = [
                'id'    => $this->selectedMenu->id,
                'name'  => $this->selectedMenu->name,
                'price' => $this->selectedMenu->price,
                'image' => $this->selectedMenu->image,
                'qty'   => 1,
                'category' => $this->selectedMenu->category // Helpful for grouped cart views
            ];
        }

        // 4. Save updated cart back to session
        session()->put('cart', $cart);

        // 5. Dispatch animation event to the browser
        $this->dispatch('item-added-to-cart', menuId: $this->selectedMenu->id);

        // 6. Flash success message and close modal
        session()->flash('message', 'Added to cart successfully!');
        $this->showModal = false;
    }

    public function render()
    {
        // Dynamic search filtering
        $menus = Menu::where('name', 'like', '%' . $this->search . '%')->get();

        return view('livewire.menu-kitchen', [
            'menus' => $menus
        ])->layout('layouts.app');
    }
}
