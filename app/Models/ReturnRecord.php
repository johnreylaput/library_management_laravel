<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReturnRecord extends Model
{
    protected $fillable = [
        'borrow_id',
        'returned_by',
        'return_date',
        'condition_status',
        'remarks',
    ];

    public function borrow(): BelongsTo
    {
        return $this->belongsTo(BorrowRecord::class, 'borrow_id');
    }
}
