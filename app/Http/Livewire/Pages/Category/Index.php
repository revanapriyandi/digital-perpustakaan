<?php

namespace App\Http\Livewire\Pages\Category;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\CategoryBook;

class Index extends Component
{
    public function showModal()
    {
        $this->dispatch('showModal');
    }

    public function render()
    {
        return view('pages.category.index');
    }
}
