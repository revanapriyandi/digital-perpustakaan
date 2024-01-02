<?php

namespace App\Http\Livewire\Pages\Books;

use App\Models\Book;
use Livewire\Component;
use Livewire\Attributes\On;

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
        $category = Book::find($this->id);
        if (!$category) {
            flash()->addPreset('error', ['message' => 'Book not found.']);
            return;
        }
        $category->delete();

        flash()->addPreset('deleted', ['title' => 'Book']);

        $this->id = null;
        $this->confirmModal = false;
        $this->dispatch('refreshDatatable');
    }

    public function render()
    {
        return view('pages.books.modal-confirm');
    }
}
