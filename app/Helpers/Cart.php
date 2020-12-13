<?php

namespace App\Helpers;

use App\Models\Product;

class Cart
{
    public function __construct()
    {
        if ($this->get() === null) {
            $this->set($this->empty());
        }
    }

    public function get()
    {
        return session()->get('cart');
    }

    public function set($cart)
    {
        session()->put('cart', $cart);
    }

    public function empty()
    {
        return [];
    }

    public function add($product)
    {
        $cart = $this->get();
        array_push($cart, $product);
        $this->set($cart);
    }

    public function remove(int $productId)
    {
        $cart = $this->get();
        array_splice($cart, array_search($productId, array_column($cart, 'id')), 1);
        $this->set($cart);
    }
}