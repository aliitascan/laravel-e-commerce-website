<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;

class AdminAddCategoryComponent extends Component
{
    public $name;
    public $slug;

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

    public function storeCategory()
    {
        $category = new Category();
        $category->name = $this->name;
        $category->slug = $this->slug;
        $category->save();
        session()->flash('message', 'Category has been created succesfully!');
    }

    public function render()
    {
        return view('livewire.admin.admin-add-category-component')->layout('layouts.base');
    }
}
