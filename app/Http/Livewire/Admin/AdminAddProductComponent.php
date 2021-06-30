<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class AdminAddProductComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $slug;
    public $shortDesc;
    public $description;
    public $regularPrice;
    public $salePrice;
    public $sku;
    public $stockStatus;
    public $featured;
    public $quantity;
    public $image;
    public $categoryId;

    public function mount()
    {
        $this->stockStatus = 'instock';
        $this->featured = 0;
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name, '-');
    }

    public function addProduct()
    {
        $product = new Product();
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->shortDesc = $this->shortDesc;
        $product->description = $this->description;
        $product->regularPrice = $this->regularPrice;
        $product->salePrice = $this->salePrice;
        $product->sku = $this->sku;
        $product->stockStatus = $this->stockStatus;
        $product->featured = $this->featured;
        $product->quantity = $this->quantity;
        $imageName = Carbon::now()->timestamp . '.' . $this->image->extension();
        $this->image->storeAs('products', $imageName);
        $product->image = $imageName;
        $product->categoryId = $this->categoryId;
        $product->save();
        session()->flash('message', 'Product has been created successfully!');
    }

    public function render()
    {
        return view('livewire.admin.admin-add-product-component', [
            'categories' => Category::all()
        ])->layout('layouts.base');
    }
}
