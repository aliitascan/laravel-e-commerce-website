<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Cart;

class DetailsComponent extends Component
{
    public $slug;
    public $qty = 1;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function store($productId, $productName, $qty, $productPrice)
    {
        Cart::add($productId, $productName, $qty, $productPrice)->associate('App\Models\Product');
        session()->flash('successMessage', 'Item Added in Cart');
        return redirect()->route('product.cart');
    }

    public function render()
    {
        $product = Product::where('slug', $this->slug)->first();
        return view('livewire.details-component', [
            'product' => $product,
            'popularProducts' => Product::inRandomOrder()->limit(4)->get(),
            'releatedProducts' => Product::where('categoryId', $product->categoryId)->inRandomOrder()->limit(5)->get()
        ])->layout('layouts.base');
    }
}
