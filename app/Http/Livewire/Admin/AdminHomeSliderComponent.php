<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomeSlider;
use Livewire\Component;

class AdminHomeSliderComponent extends Component
{
    public function deleteSlide($id)
    {
        HomeSlider::find($id)->delete();
        session()->flash('message', 'Slide has been removed successfully!');
    }

    public function render()
    {
        return view('livewire.admin.admin-home-slider-component', [
            'slides' => HomeSlider::all()
        ])->layout('layouts.base');
    }
}
