<?php

namespace App\Models;

use App\base\Entities\Enums\BasketState;
use App\Trait\date_convert;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class basket extends Model
{
    use HasFactory,date_convert;

    const UPDATED_AT=null;

    protected $fillable=[
        'user_id',
        'box_id',
        'size_id',
        'name',
        'mobile',
        'ip',
        'state',
        'expired_at',
        'created_at'
    ];


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

    public function size()
    {
        return $this->belongsTo(size::class,'size_id');
    }
}
