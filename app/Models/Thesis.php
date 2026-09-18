<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Thesis extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'authors',
        'author',
        'thesis_type',
        'research',
        'institution',
        'year',
        'date_published',
        'pages',
        'category_id',
        'author_id',
        'publisher_id',
        'link',
        'abstract',
        'summary',
        'description',
        'status',
        'database_collection',
        'availability',
        'subjects',
        'subjects_keywords',
        'added_by',
        'edited_by',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function advisor(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Publisher::class);
    }
}
