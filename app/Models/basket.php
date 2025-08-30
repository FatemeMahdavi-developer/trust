<?php

namespace App\Models;

use App\Base\Entities\Enums\BasketState;
use App\Base\Entities\Enums\PricingType;
use App\Trait\date_convert;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class basket extends Model
{
    use HasFactory,date_convert;

    const UPDATED_AT=null;

    protected $fillable=[
        'user_id',
        'box_id',
        'branch_id',
        'locker_bank_id',
        'size_id',
        'name',
        'mobile',
        'ip',
        'state',
        'expired_at',
        'created_at'
    ];

    public function calculatePrice(): float
    {
        $start = Carbon::now();
        $end = Carbon::parse($this->expired_at);

        $lockerbank=$this->with('lockerbank')->first()->lockerbank;

        return match($lockerbank->pricing_type->value) {
            PricingType::HOURLY->value => max(1,$start->diffInHours($end)) * $lockerbank->price,
            PricingType::DAILY->value => max(1,$start->diffInDays($end)) * $lockerbank->price,
            PricingType::MONTHLY->value => max(1,$start->diffInMonths($end)) * $lockerbank->price,
            default => 0
            // todo: default => throw new InvalidArgumentException('نوع قیمت‌گذاری نامعتبر')
        };
    }



    protected $casts = [
        'state' => BasketState::class,
    ];

    public function enumsLang(): array
    {
        return __('enums');
    }

    public function box()
    {
        return $this->belongsTo(box::class,'box_id');
    }

    public function lockerBank()
    {
        return $this->belongsTo(lockerBank::class,'locker_bank_id');
    }


}
