<?php

namespace App\Http\Livewire\App;

use App\Models\Product;
use Livewire\Component;
use App\Models\Restaurant;

class Menu extends Component
{
    public Restaurant $restaurant;
    public $products = [];
    public $filter = '';
    public $selectedProduct = null;

    public function mount(Restaurant $restaurant)
    {
        $this->restaurant = $restaurant;
    }

    public function loadProducts()
    {
        $this->products = Product::productByRestaurantFilterByCategory($this->restaurant->id, $this->filter);
    }

    public function selectProduct(Product $product)
    {
        if ($product) {
            $this->selectedProduct = $product;
        } else {
            $this->selectedProduct = null;
        }
    }

    public function sortBy($id)
    {
        $this->filter = $id;
        $this->products = Product::productByRestaurantFilterByCategory($this->restaurant->id, $this->filter);
    }


    public function render()
    {
        return view('livewire.app.menu', [
            'categories' => $this->restaurant->categories->sortBy('order')->toBase()
        ]);
    }
}
