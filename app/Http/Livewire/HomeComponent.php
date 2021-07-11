<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\HomeCategory;
use App\Models\HomeSlider;
use App\Models\Product;
use Livewire\Component;

class HomeComponent extends Component
{
    public $numberOfProducts = 10;

    public function render()
    {
        $homeCategories = HomeCategory::find(1);
        $this->numberOfProducts = $homeCategories->no_of_products;
        $cats = explode(',', $homeCategories->sel_categories);
        $categories = Category::whereIn('id', $cats)->get()->map(function ($category) {
            return $category->setRelation('products', $category->products->take($this->numberOfProducts));
        });
        return view('livewire.home-component', [
            'slides' => HomeSlider::where('status', 1)->get(),
            'latestProducts' => Product::orderBy('created_at', 'DESC')->get()->take(10),
            'products' => Product::where('salePrice', '>', 0)->inRandomOrder()->get()->take(8),
            'categories' => $categories,
        ])->layout('layouts.base');
    }
}
