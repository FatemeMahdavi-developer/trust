<?php

namespace App\Models;

use App\Base\Entities\Enums\PricingType;
use App\Base\Entities\Enums\SizeLocker;
use App\Trait\date_convert;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LockerBank extends Model
{
    use HasFactory, date_convert;

    protected $table = "locker_banks";

    protected $appends=['full_name'];

    protected $fillable = [
        "code",
        "size",
        "qrcode",
        "branch_id",
        "price",
        "pricing_type"
    ];
    protected $casts=[
        'size'=>SizeLocker::class,
        'pricing_type'=>PricingType::class
    ];

    public function enumsLang(): array
    {
        return __('enums');
    }
    public function scopeFilter(Builder $builder, $params)
    {
        if (!empty($params['code'])) {
            $builder->where('code', $params['code']);
        }
        if (!empty($params['size'])) {
            $builder->where('size', $params['size']);
        }
        if (!empty($params['branch_id'])) {
            $builder->where('branch_id', $params['branch_id']);
        }
        return $builder;
    }

    public function getFullNameAttribute()
    {
        return "کد: ".$this->code.'- سایز : '. $this->size->value;
    }

    /*
     * Its Return Branch
     * @returned string | null
     * */

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function boxes(): HasMany
    {
        return $this->hasMany(box::class);
    }
}
