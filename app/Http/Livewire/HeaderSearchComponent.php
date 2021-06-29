<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class HeaderSearchComponent extends Component
{
    public $search;
    public $productCat;
    public $productCatId;

    public function mount()
    {
        $this->productCat = 'All Category';
        $this->fill(request()->only('search', 'productCat', 'productCatId'));
    }

    public function render()
    {

        return view('livewire.header-search-component', [
            'categories' => Category::all()
        ]);
    }
}
