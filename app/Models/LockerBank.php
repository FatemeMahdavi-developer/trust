<?php

namespace App\Models;

use App\Base\Entities\Enums\SizeLocker;
use App\Trait\date_convert;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LockerBank extends Model
{
    use HasFactory, date_convert;

    protected $table = "locker_banks";
    protected $fillable = [
        "code",
        "size",
        "qrcode",
        "branch_id"
    ];
    protected $casts=[
        'size'=>SizeLocker::class
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

    /*
     * Its Return Branch
     * @returned string | null
     * */

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }
}
