<?php

namespace App\Http\Livewire;

use App\Models\ProductMenu;
use App\Models\Restaurant;
use Livewire\Component;

class Menu extends Component
{
    public Restaurant $restaurant;
    public $categories;
    public $products;

    public function mount(Restaurant $restaurant) 
    {
        $this->restaurant = $restaurant;
        $this->categories = $restaurant->categories->sortBy('order');
        $this->products = ProductMenu::where('r_id', $restaurant->id)->get()->groupBy('c_name')->toBase();
    }

    public function render()
    {
        return view('livewire.menu');
    }
}
