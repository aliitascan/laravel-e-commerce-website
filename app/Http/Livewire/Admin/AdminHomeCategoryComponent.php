<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\HomeCategory;
use Livewire\Component;

class AdminHomeCategoryComponent extends Component
{
    public $selectedCategories = array();
    public $numberOfProducts;

    public function mount()
    {
        $category = HomeCategory::find(1);
        $this->selectedCategories = explode(',', $category->sel_categories);
        $this->numberOfProducts = $category->no_of_products;
    }

    public function updateHomeCategory()
    {
        $category = HomeCategory::find(1);
        $category->sel_categories = implode(',', $this->selectedCategories);
        $category->no_of_products = $this->numberOfProducts;
        $category->save();
        session()->flash('message', 'Home Category has been updated successfully!');
    }

    public function render()
    {
        return view('livewire.admin.admin-home-category-component', [
            'categories' => Category::all()
        ])->layout('layouts.base');
    }
}
