<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

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
}