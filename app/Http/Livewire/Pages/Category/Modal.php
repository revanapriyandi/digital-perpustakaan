<?php

namespace App\Http\Livewire\Pages\Category;

use App\Models\CategoryBook;
use Livewire\Attributes\On;
use Livewire\Component;

class Modal extends Component
{
    public $showModal = false;
    public $show = false;

    public $id;
    public $name;
    public $description;
    public $status = true;

    #[On('showModal')]
    public function fillData($edit = '', $show = false)
    {
        $this->showModal = true;
        $this->show = false;
        $this->id = null;

        if ($edit) {
            $category = CategoryBook::find($edit);

            $this->id = $category->id;
            $this->name = $category->name;
            $this->description = $category->description;
            $this->status = $category->is_active;
            if ($show) {
                $this->show = true;
            }
        }
    }


    public function submit()
    {
        $this->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:category_books,name' . ($this->id ? ',' . $this->id : '')
            ],
            'description' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'boolean'],
        ]);

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'is_active' => $this->status,
        ];

        CategoryBook::updateOrCreate($data);

        $this->reset();

        flash()->addPreset('saved', ['title' => 'Category']);

        $this->dispatch('refreshDatatable');
        $this->showModal = false;
    }

    public function render()
    {
        return view('pages.category.modal');
    }
}
