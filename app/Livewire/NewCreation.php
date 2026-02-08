<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class NewCreation extends Component
{
    use WithFileUploads;

    // Property untuk menampung data form
    public $designation;
    public $classification;
    public $price;
    public $availability = 'In Stock'; // Default value sesuai permintaan
    public $narrative;
    public $photo;

    public function save()
    {
        $this->validate([
            'designation'    => 'required|min:3',
            'classification' => 'required',
            'price'          => 'required|numeric',
            'availability'   => 'required',
            'photo'          => 'nullable|image|max:2048', // Maksimal 2MB
        ]);

        // Logika simpan data ke database (Model::create...) bisa ditaruh di sini
        
        session()->flash('message', 'Creation successfully added to the gallery.');
    }

    public function render()
    {
        return view('livewire.new-creation');
    }
}