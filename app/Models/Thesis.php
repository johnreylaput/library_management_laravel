<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Thesis extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'author',
        'research',
        'date_published',
        'subjects_keywords',
        'summary',
        'status',
        'cover_image',
        'added_by',
        'edited_by',
    ];

    public function getCoverImageUrlAttribute(): ?string
    {
        if ($this->cover_image) {
            return Storage::url($this->cover_image);
        }

        return null;
    }
}
