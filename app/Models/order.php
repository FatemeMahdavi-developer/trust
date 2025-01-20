<?php

namespace App\Models;

use App\base\Entities\Enums\OrderType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    const UPDATED_AT=null;

    protected $fillable=[
        'basket_id',
        'size_id',
        'user_id',
        'payment_id',
        'type',
        'size_title',
        'price',
        'number_box',
        'kind_payment',
        'state',
        'ref_number'
    ];

    protected $casts = [
        'state' => OrderType::class,
    ];

    public function enumsLang(): array
    {
        return __('enums');
    }
}
