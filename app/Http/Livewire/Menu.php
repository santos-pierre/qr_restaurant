<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Restaurant;

class Menu extends Component
{
    public Restaurant $restaurant;
    public $categoryIdSelected = null;

    public function mount(Restaurant $restaurant)
    {
        $this->restaurant = $restaurant;
    }

    public function sortBy($id)
    {
        $this->categoryIdSelected = $id;
    }

    public function render()
    {
        return view('livewire.menu', [
            'categories' => $this->restaurant->categories->sortBy('order')->toBase(),
            'products' => Product::productByRestaurantFilterByCategory($this->restaurant->id, $this->categoryIdSelected),
        ]);
    }
}
