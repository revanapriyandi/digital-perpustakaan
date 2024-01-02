<?php

namespace App\Http\Livewire\Pages\Category;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\CategoryBook;

class ModalConfirm extends Component
{
    public $id;
    public $confirmModal = false;

    #[On('deleteData')]
    public function deleteData($id)
    {
        $this->id = null;
        $this->confirmModal = true;
        if ($id) {
            $this->id = $id;
        }
    }

    #[On('confirmDelete')]
    public function confirmDelete()
    {
        $category = CategoryBook::find($this->id);
        if (!$category) {
            flash()->addPreset('error', ['message' => 'Category not found.']);
            return;
        }
        $category->delete();

        flash()->addPreset('deleted', ['title' => 'Category']);

        $this->id = null;
        $this->confirmModal = false;
        $this->dispatch('refreshDatatable');
    }

    public function render()
    {
        return view('pages.category.modal-confirm');
    }
}
