<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'category_book_id',
        'description',
        'stock',
        'created_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'cover',
        'cover_url',
        'file',
        'media_pdf',
        'media_pdf_size',
    ];

    /**
     * Get the category book that owns the book.
     */
    public function category()
    {
        return $this->belongsTo(CategoryBook::class, 'category_book_id', 'id');
    }

    /**
     * Get the user that owns the book.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function getCoverUrlAttribute()
    {
        return $this->cover ? $this->cover
            : 'https://ui-avatars.com/api/?name=' . $this->title
            . '&color=7F9CF5&background=EBF4FF';
    }

    public function getCoverAttribute()
    {
        return $this->getFirstMediaUrl('cover');
    }

    public function deleteCover()
    {
        $this->clearMediaCollection('cover');
    }

    public function getFileAttribute()
    {
        return $this->getFirstMediaUrl('file');
    }

    public function deleteFile()
    {
        $this->clearMediaCollection('file');
    }

    public function getMediaPdfAttribute()
    {
        return $this->getFirstMedia('file');
    }

    public function getMediaPdfSizeAttribute()
    {
        return $this->media_pdf ? round($this->media_pdf->size / 1024 / 1024, 2) : 0;
    }
}
