<?php

namespace App\Http\Livewire\Pages\Books;

use App\Models\Book;
use Livewire\Component;
use App\Models\CategoryBook;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

class FormBook extends Component
{
    use WithFileUploads;

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

    public function submit()
    {
        $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'exists:category_books,id'],
            'description' => ['required', 'string'],
            'jumlah' => ['required', 'numeric'],
            'cover' => ['required', 'image', 'max:2048'],
            'filepdf' => ['required', 'file', 'max:10240', 'mimes:pdf']
        ]);

        $data = [
            'title' => $this->title,
            'category_book_id' => $this->category,
            'description' => $this->description,
            'stock' => $this->jumlah,
            'created_by' => auth()->user()->id
        ];

        $book = Book::updateOrCreate($data);

        $book->addMedia($this->cover->getRealPath())
            ->usingFileName($this->title . '.' . $this->cover->getClientOriginalExtension())
            ->toMediaCollection('cover');

        $book->addMedia($this->filepdf->getRealPath())
            ->usingFileName($this->title . '.' . $this->filepdf->getClientOriginalExtension())
            ->toMediaCollection('file');

        $this->reset([
            'title',
            'category',
            'description',
            'jumlah',
            'cover',
            'filepdf'
        ]);

        flash()->addPreset('saved', ['title' => 'Book']);

        $this->redirect(route('books.edit', $book->id), true);
    }

    public function downloadFilePdf()
    {
        return response()->download($this->book->getFirstMediaPath('file'), $this->book->title . '.pdf');
    }

    public function render()
    {
        return view('pages.books.form-book');
    }
}
