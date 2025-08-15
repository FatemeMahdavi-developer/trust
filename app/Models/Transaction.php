<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'ref_number',
        'status',
        'price',
        'card_number',
        'gateway',
        'comment',
        // 'payment_type',
        'comment',
        'payment_at',
        'old_wallet',
        'new_wallet',
        'params',
    ];

    public function transactionable()
    {
        return $this->morphTo();
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'params' => 'array',
    ];
}
