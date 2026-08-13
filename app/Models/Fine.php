<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fine extends Model
{
    protected $fillable = [
        'borrow_id',
        'amount',
        'reason',
        'paid',
    ];

    public function borrow(): BelongsTo
    {
        return $this->belongsTo(BorrowRecord::class);
    }
}
