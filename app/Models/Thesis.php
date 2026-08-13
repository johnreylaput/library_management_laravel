<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Thesis extends Model
{
    protected $fillable = [
        'title',
        'authors',
        'thesis_type',
        'institution',
        'year',
        'pages',
        'category_id',
        'author_id',
        'publisher_id',
        'link',
        'abstract',
        'description',
        'status',
        'database_collection',
        'availability',
        'subjects',
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
