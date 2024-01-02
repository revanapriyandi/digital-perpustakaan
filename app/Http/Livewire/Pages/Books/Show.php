<?php

namespace App\Http\Livewire\Pages\Books;

use App\Models\Book;
use Livewire\Component;
use App\Models\CategoryBook;

class Show extends Component
{
    public $categories;
    public $book;

    public $id;
    public $title;
    public $category;
    public $description;
    public $jumlah;
    public $cover;
    public $filepdf;

    public function backToIndex()
    {
        $this->redirect(route('books.index'), true);
    }

    public function mount()
    {
        $this->categories = CategoryBook::isActive()->get();

        if (isset($this->id)) {
            $book = Book::find($this->id);

            if ($book->created_by != auth()->user()->id) {
                flash()->addPreset('error', ['message' => 'Anda tidak memiliki akses ke halaman ini']);
                $this->redirect(route('books.index'), true);
            }
            $this->book = $book;
            $this->title = $book->title;
            $this->category = $book->category_book_id;
            $this->description = $book->description;
            $this->jumlah = $book->stock;
        }
    }

    public function downloadImage()
    {
        return response()->download($this->book->getFirstMediaPath('cover'), $this->book->title . '.png');
    }

    public function downloadFilePdf()
    {
        return response()->download($this->book->getFirstMediaPath('file'), $this->book->title . '.pdf');
    }

    public function render()
    {
        return view('pages.books.show');
    }
}
