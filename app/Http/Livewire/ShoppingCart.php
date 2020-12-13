<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class ShoppingCart extends Component
{
    public $categories;
    public $products;
    public $price = 0;
    public $amount = 0;

    public $category = null;
    public $product = null;

    public function mount()
    {
        $this->categories = Category::all();
        $this->products = collect();
    }

    public function render()
    {
        return view('livewire.shopping-cart');
    }

    public function updatedCategory($category)
    {
        $this->products = Product::where('category_id', $category)->get();
        $this->price = 0;
        $this->amount = 0;
    }

    public function updatedProduct($product)
    {
        $this->price = Product::where('id', $product)->value('price');
        $this->amount = 1;
    }
}
