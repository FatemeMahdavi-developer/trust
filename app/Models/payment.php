<?php

namespace App\Models;

use App\base\Entities\Enums\PaymentType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    use HasFactory;

    const UPDATED_AT=null;

    protected $fillable=[
        'name',
        'bank',
        'account_number_id',
        'fish_number',
        'state'
    ];

    protected $casts = [
        'state' => PaymentType::class,
    ];

    public function enumsLang(): array
    {
        return __('enums');
    }

    public function accountNumber(){
        return $this->belongsTo(account_number::class,'account_number_id');
    }
}
