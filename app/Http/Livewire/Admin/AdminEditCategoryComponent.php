<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;

class AdminEditCategoryComponent extends Component
{
    public $categorySlug;
    public $categoryId;
    public $name;
    public $slug;

    public function mount($categorySlug)
    {
        $this->categorySlug = $categorySlug;
        $category = Category::where('slug', $this->categorySlug)->first();
        $this->categoryId = $category->id;
        $this->name = $category->name;
        $this->slug = $category->slug;
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
        $this->slugExistControl();
    }

    public function slugExistControl()
    {
        if (Category::where('slug', $this->slug)->count() > 0) {
            session()->flash('exist', 'This slug already exist. Please change slug!');
        }
    }

    public function updateCategory()
    {
        $category = Category::find($this->categoryId);
        $category->name = $this->name;
        $category->slug = $this->slug;
        $category->save();
        session()->flash('message', 'Category has been updated successfully!');
    }

    public function render()
    {
        return view('livewire.admin.admin-edit-category-component')->layout('layouts.base');
    }
}
