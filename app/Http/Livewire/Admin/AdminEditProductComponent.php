<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Livewire\WithFileUploads;

class AdminEditProductComponent extends Component
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
    public $newImage;
    public $productId;

    public function mount($productSlug)
    {
        $product = Product::where('slug', $productSlug)->first();
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->shortDesc = $product->shortDesc;
        $this->description = $product->description;
        $this->regularPrice = $product->regularPrice;
        $this->salePrice = $product->salePrice;
        $this->sku = $product->SKU;
        $this->stockStatus = $product->stockStatus;
        $this->featured = $product->featured;
        $this->quantity = $product->quantity;
        $this->image = $product->image;
        $this->categoryId = $product->categoryId;
        $this->productId = $product->id;
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name, '-');
    }

    public function updateProduct()
    {
        $product = Product::find($this->productId);
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->shortDesc = $this->shortDesc;
        $product->description = $this->description;
        $product->regularPrice = $this->regularPrice;
        $product->salePrice = $this->salePrice;
        $product->SKU = $this->sku;
        $product->stockStatus = $this->stockStatus;
        $product->featured = $this->featured;
        $product->quantity = $this->quantity;
        if ($this->newImage) {
            $imageName = Carbon::now()->timestamp . '.' . $this->newImage->extension();
            $this->newImage->storeAs('products', $imageName);
            $product->image = $imageName;
        }
        $product->categoryId = $this->categoryId;
        $product->save();
        session()->flash('message', 'Product has been updated successfully!');
    }

    public function render()
    {
        return view('livewire.admin.admin-edit-product-component', [
            'categories' => Category::all()
        ])->layout('layouts.base');
    }
}
