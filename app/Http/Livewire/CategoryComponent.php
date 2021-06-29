<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;
use App\Models\Category;

class CategoryComponent extends Component
{
    public $sorting;
    public $pageSize;
    public $categorySlug;

    public function mount($categorySlug)
    {
        $this->sorting = "default";
        $this->pageSize = 12;
        $this->categorySlug = $categorySlug;
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
            $products = Product::where('categoryId', Category::where('slug', $this->categorySlug)->first()->id)->orderBy('created_at', 'DESC')->paginate($this->pageSize);
        } else if ($this->sorting == 'price') {
            $products = Product::where('categoryId', Category::where('slug', $this->categorySlug)->first()->id)->orderBy('regularPrice', 'ASC')->paginate($this->pageSize);
        } else if ($this->sorting == 'priceDesc') {
            $products = Product::where('categoryId', Category::where('slug', $this->categorySlug)->first()->id)->orderBy('regularPrice', 'DESC')->paginate($this->pageSize);
        } else {
            $products = Product::where('categoryId', Category::where('slug', $this->categorySlug)->first()->id)->paginate($this->pageSize);
        }

        return view('livewire.category-component', [
            'categories' => Category::withCount('products')->get(),
            'products' => $products,
            'popularProducts' => Product::inRandomOrder()->limit(4)->get(),
            'categoryName' => Category::where('slug', $this->categorySlug)->first()->name
        ])->layout('layouts.base');
    }
}
