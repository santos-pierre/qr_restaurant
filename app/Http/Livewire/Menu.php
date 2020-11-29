<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Restaurant;

class Menu extends Component
{
    public Restaurant $restaurant;
    public $products = [];
    public $filter = '';

    public function mount(Restaurant $restaurant)
    {
        $this->restaurant = $restaurant;
    }

    public function loadProducts()
    {
        $this->products = Product::productByRestaurantFilterByCategory($this->restaurant->id, $this->filter);
    }

    public function sortBy($id)
    {
        $this->filter = $id;
        $this->products = Product::productByRestaurantFilterByCategory($this->restaurant->id, $this->filter);
    }


    public function render()
    {
        return view('livewire.menu', [
            'categories' => $this->restaurant->categories->sortBy('order')->toBase()
        ]);
    }
}
