<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;
use App\Models\Category;

class ShopComponent extends Component
{
    public $sorting;
    public $pageSize;

    public function mount()
    {
        $this->sorting = "default";
        $this->pageSize = 12;
    }

    public function store($productId, $productName, $productPrice)
    {
        Cart::add($productId, $productName, 1, $productPrice)->associate('App\Models\Product');
        session()->flash('successMessage', 'Item Added in Cart');
        return redirect()->route('product.cart');
    }

    use WithPagination;
    public function render()
    {
        if ($this->sorting == 'date') {
            $products = Product::orderBy('created_at', 'DESC')->paginate($this->pageSize);
        } else if ($this->sorting == 'price') {
            $products = Product::orderBy('regularPrice', 'ASC')->paginate($this->pageSize);
        } else if ($this->sorting == 'priceDesc') {
            $products = Product::orderBy('regularPrice', 'DESC')->paginate($this->pageSize);
        } else {
            $products = Product::paginate($this->pageSize);
        }

        return view('livewire.shop-component', [
            'categories' => Category::withCount('products')->get(),
            'products' => $products,
            'popularProducts' => Product::inRandomOrder()->limit(4)->get()
        ])->layout('layouts.base');
    }
}
