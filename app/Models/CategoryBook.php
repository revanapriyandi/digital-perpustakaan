<?php

namespace App\Models;

use App\Models\Scopes\ActivedScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryBook extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description'
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
     * Get the books for the category book.
     */
    public function books()
    {
        return $this->hasMany(Book::class, 'category_book_id', 'id');
    }

    public function scopeisActive($query)
    {
        return $query->where('is_active', true);
    }
}
