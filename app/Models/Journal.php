<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Journal extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'journal_name',
        'title',
        'source',
        'authors',
        'volume',
        'issue',
        'pages',
        'publication_date',
        'doi',
        'issn',
        'link',
        'category_id',
        'publisher_id',
        'publisher_text',
        'abstract',
        'description',
        'cover_image',
        'status',
        'database_collection',
        'availability',
        'subjects',
        'keyword',
        'added_by',
        'edited_by',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Publisher::class);
    }

    public function getCoverImageUrlAttribute(): ?string
    {
        if ($this->cover_image) {
            return asset('storage/'.$this->cover_image);
        }

        return null;
    }
}
