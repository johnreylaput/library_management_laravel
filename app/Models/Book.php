<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'author',
        'title',
        'edition',
        'year',
        'subject',
        'publication',
        'added_by',
        'edited_by',
    ];

    protected function casts(): array
    {
        return [
            'year' => 'integer',
        ];
    }

}
