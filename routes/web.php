<?php

use App\Http\Livewire\Pages\Category\Index;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/data/category', App\Http\Livewire\Pages\Category\Index::class)->name('category.index');

    Route::get('/books', App\Http\Livewire\Pages\Books\Index::class)->name('books.index');
    Route::get('/books/create', App\Http\Livewire\Pages\Books\FormBook::class)->name('books.create');
    Route::get('/books/{id}/edit', App\Http\Livewire\Pages\Books\FormBook::class)->name('books.edit');
    Route::get('/books/{id}/show', App\Http\Livewire\Pages\Books\Show::class)->name('books.show');
});
