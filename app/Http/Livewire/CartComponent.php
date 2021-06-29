<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;

class CartComponent extends Component
{
    public function increaseQty($rowId)
    {
        Cart::update($rowId, Cart::get($rowId)->qty + 1);
    }

    public function decreaseQty($rowId)
    {
        Cart::update($rowId, Cart::get($rowId)->qty - 1);
    }

    public function deleteProduct($rowId)
    {
        Cart::remove($rowId);
        session()->flash('successMessage', 'Item has been removed');
    }

    public function clearCart()
    {
        Cart::destroy();
        session()->flash('successMessage', 'Cart has been cleared');
    }

    public function render()
    {
        return view('livewire.cart-component')->layout('layouts.base');
    }
}
