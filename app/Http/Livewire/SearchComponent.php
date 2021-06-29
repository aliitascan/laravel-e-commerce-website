<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;
use App\Models\Category;

class SearchComponent extends Component
{
    public $sorting;
    public $pageSize;

    public $search;
    public $ProductCat;
    public $ProductCatId;

    public function mount()
    {
        $this->sorting = "default";
        $this->pageSize = 12;
        $this->fill(request()->only('search', 'productCat', 'productCatId'));
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
            $products = Product::where('name', 'LIKE', '%' . $this->search . '%')->where('categoryId', 'LIKE', '%' . $this->ProductCatId . '%')->orderBy('created_at', 'DESC')->paginate($this->pageSize);
        } else if ($this->sorting == 'price') {
            $products = Product::where('name', 'LIKE', '%' . $this->search . '%')->where('categoryId', 'LIKE', '%' . $this->ProductCatId . '%')->orderBy('regularPrice', 'ASC')->paginate($this->pageSize);
        } else if ($this->sorting == 'priceDesc') {
            $products = Product::where('name', 'LIKE', '%' . $this->search . '%')->where('categoryId', 'LIKE', '%' . $this->ProductCatId . '%')->orderBy('regularPrice', 'DESC')->paginate($this->pageSize);
        } else {
            $products = Product::where('name', 'LIKE', '%' . $this->search . '%')->where('categoryId', 'LIKE', '%' . $this->ProductCatId . '%')->paginate($this->pageSize);
        }

        return view('livewire.search-component', [
            'categories' => Category::withCount('products')->get(),
            'products' => $products,
            'popularProducts' => Product::inRandomOrder()->limit(4)->get()
        ])->layout('layouts.base');
    }
}
