<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
        'author_name',
        'title',
        'edition',
        'year',
        'subject',
        'publication',
    ];
}