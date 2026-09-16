<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['category_name', 'description'];

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    public function journals(): HasMany
    {
        return $this->hasMany(Journal::class);
    }

    public function theses(): HasMany
    {
        return $this->hasMany(Thesis::class);
    }
}
