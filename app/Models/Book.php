<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    protected $fillable = [
        'accession_no',
        'isbn',
        'title',
        'category_id',
        'author_id',
        'publisher_id',
        'publication_year',
        'edition',
        'language',
        'pages',
        'quantity',
        'available_quantity',
        'shelf_location',
        'book_cover',
        'description',
        'status',
        'added_by',
        'edited_by',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Publisher::class);
    }
}
