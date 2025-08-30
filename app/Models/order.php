<?php

namespace App\Models;

use App\Base\Entities\Enums\OrderType;
use App\Base\Entities\Enums\SettlementStatusOfOrder;
use App\Base\Entities\Enums\SizeLocker;
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
        'user_id',
        'type',
        'size',
        'price',
        'box_id',
        'kind_payment',
        'state',
        'ref_number',
        'pay_way'
    ];

    protected $casts = [
        'state' => TransactionStatusEnum::class,
        'size'=>SizeLocker::class,
        'kind_payment'=>OrderType::class,
        'settlement_status'=>SettlementStatusOfOrder::class
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

    public function basket(){
        return $this->belongsTo(basket::class,'basket_id');
    }

    public function box(){
        return $this->belongsTo(box::class,'box_id');
    }

}
