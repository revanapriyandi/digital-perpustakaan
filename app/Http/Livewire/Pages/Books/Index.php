<?php

namespace App\Http\Livewire\Pages\Books;

use App\Models\Book;
use Exception;
use Livewire\Component;
use Livewire\Attributes\On;
use Spatie\LaravelPdf\Facades\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Shuchkin\SimpleXLSXGen;

class Index extends Component
{

    #[On('showForm')]
    public function showForm()
    {
        $this->redirect(route('books.create'), true);
    }

    #[On('showEditForm')]
    public function showEditForm($id)
    {
        $this->redirect(route('books.edit', $id), true);
    }

    #[On('downloadFile')]
    public function downloadFile($id)
    {
        $this->dispatch('refreshDatatable');
        $book = Book::find($id);
        if ($book->getFirstMedia('file')) {
            return response()->download($book->getFirstMediaPath('file'), $book->title . '.pdf');
        }

        flash()->addPreset('error', ['message' => 'File tidak ditemukan']);
    }

    #[On('showForm')]
    public function showData($id)
    {
        $this->redirect(route('books.show', $id), true);
    }

    public function exportExcel()
    {
        ini_set('memory_limit', '4096M');
        ini_set('max_execution_time', 0);

        try {
            $books = Book::with(['category'])->where('created_by', auth()->id())->get();
            $data = [
                ['Judul', 'Kategori', 'Deskripsi', 'Jumlah', 'File PDF', 'Cover', 'Dibuat Oleh']
            ];
            foreach ($books as $book) {
                $data[] = [
                    'title' => $book->title,
                    'category' => $book->category->name,
                    'description' => $book->description,
                    'jumlah' => $book->stock,
                    'file' => $book->getFirstMediaUrl('file'),
                    'cover' => $book->getFirstMediaUrl('cover'),
                    'created_by' => $book->user->name,
                ];
            }
            SimpleXLSXGen::fromArray($data);
            $xlsx = SimpleXLSXGen::fromArray($data);
            $xlsx->saveAs('books.xlsx');
            return response()->download('books.xlsx');
        } catch (Exception $e) {
            flash()->addPreset('error', ['message' => $e->getMessage()]);
        }
    }

    public function render()
    {
        return view('pages.books.index');
    }
}
