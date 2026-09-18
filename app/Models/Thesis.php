<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        'added_by',
        'edited_by',
    ];
}
