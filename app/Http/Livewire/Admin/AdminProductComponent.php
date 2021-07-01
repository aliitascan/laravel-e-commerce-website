<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class AdminProductComponent extends Component
{
    use WithPagination;

    public function deleteProduct($id)
    {
        Product::find($id)->delete();
        session()->flash('message', 'Product has been deleted successfully!');
    }

    public function render()
    {
        return view('livewire.admin.admin-product-component', [
            'products' => Product::paginate(10)
        ])->layout('layouts.base');
    }
}
