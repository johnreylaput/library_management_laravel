<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

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
        'cover_image',
        'added_by',
        'edited_by',
    ];

    protected function casts(): array
    {
        return [
            'year' => 'integer',
        ];
    }

    public function getCoverImageUrlAttribute(): ?string
    {
        if ($this->cover_image) {
            return asset('storage/' . $this->cover_image);
        }

        return null;
    }

    public function getAddedByNameAttribute(): ?string
    {
        if (!$this->added_by) {
            return null;
        }

        return DB::table('users')->where('id', $this->added_by)->value('full_name')
            ?: DB::table('users')->where('id', $this->added_by)->value('username');
    }

    public function getEditedByNameAttribute(): ?string
    {
        if (!$this->edited_by) {
            return null;
        }

        return DB::table('users')->where('id', $this->edited_by)->value('full_name')
            ?: DB::table('users')->where('id', $this->edited_by)->value('username');
    }

}
