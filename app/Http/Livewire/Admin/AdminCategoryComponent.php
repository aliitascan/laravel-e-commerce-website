<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCategoryComponent extends Component
{
    public function deleteCategory($id)
    {
        Category::find($id)->delete();
        session()->flash('message', 'Category has been deleted successfully!');
    }

    use WithPagination;
    public function render()
    {
        return view('livewire.admin.admin-category-component', [
            'categories' => Category::paginate(5)
        ])->layout('layouts.base');
    }
}
