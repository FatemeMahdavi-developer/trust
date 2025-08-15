<?php

namespace App\Models;

use App\Base\Entities\Enums\TransactionStatusEnum;
use App\Trait\date_convert;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class order extends Model
{
    use HasFactory,date_convert,SoftDeletes;

    const UPDATED_AT=null;

    protected $fillable=[
        'basket_id',
        'size_id',
        'user_id',
        'payment_id',
        'type',
        'size_title',
        'price',
        'box_id',
        'kind_payment',
        'state',
        'ref_number',
        'pay_way'
    ];

    protected $casts = [
        'state' => TransactionStatusEnum::class,
    ];

    public function transaction()
    {
        return $this->morphOne(Transaction::class,'transactionable');
    }

    public function enumsLang(): array
    {
        return __('enums');
    }
    public function scopeSiteFilter(Builder $builder,$params)
    {
        if (!empty($params['title'])) {
            $builder->where('title', 'like', '%' . $params['title'] . '%');
        }
        return $builder;
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function size(){
        return $this->belongsTo(size::class,'size_id');
    }

    public function basket(){
        return $this->belongsTo(basket::class,'basket_id');
    }

    public function payment(){
        return $this->belongsTo(payment::class,'payment_id');
    }


}
