<?php

namespace App\Http\Livewire;

use App\Facades\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Livewire\Component;

class ShoppingCart extends Component
{
    public $cart;

    public $categories;
    public $products;
    public $price = 0;
    public $amount = 0;

    public $category = null;
    public $product = null;

    public function mount()
    {
        $this->cart = Cart::get();
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

    public function addToCart()
    {
        $checkProduct = array_search($this->product, array_column($this->cart, 'id'));
        if ($checkProduct === false) {
            $product = Product::where('id', $this->product)->first();
            $product = [
                'id' => $this->product,
                'category_id' => $this->category,
                'name' => $product->name,
                'price' => $this->price,
                'amount' => $this->amount,
            ];
    
            Cart::add($product);
    
            $this->category = null;
            $this->product = null;
            $this->price = 0;
            $this->amount = 0;
    
            $this->cart = Cart::get();
        } else {
            $amount = $this->cart[$checkProduct]['amount'] + $this->amount;

            $this->cart[$checkProduct]['amount'] = $amount;

            $this->category = null;
            $this->product = null;
            $this->price = 0;
            $this->amount = 0;


            Cart::set($this->cart);
            $this->cart = Cart::get();
        }
    }

    public function removeProduct($productId)
    {
        Cart::remove($productId);
        $this->cart = Cart::get();
    }

    public function checkout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('shopping.cart');
    }
}
