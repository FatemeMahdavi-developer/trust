<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Trait\date_convert;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Morilog\Jalali\Jalalian;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,date_convert,SoftDeletes;

    protected $appends=["fullname","date_birth_convert"];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lastname',
        'username',
        'email',
        'state',
        'password',
        'new_password',
        'confirm_code',
        'expire_confirm_at',
        'national_code',
        'gender',
        'date_birth',
        'date',
        'mobile',
        'email',
        'postal_code',
        'province',
        'city',
        'address',
        'tell',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getGravatorAttribute(){
        $hash=md5(strtolower($this->email));
        return 'http://s.gravator.com/avator/'.$hash;
    }

    public function getFullnameAttribute(){
        return $this->name." ".$this->lastname;
    }

    public function comment(){
        return $this->hasMany(comment::class,'user_id');
    }

    public function getdateBirthConvertAttribute(){
        return is_null($this->date_birth) ? '' :Jalalian::forge($this->date_birth)->format('Y-m-d') ;
    }

    public function scopeFilter(Builder $builder,array $params){
        if (!empty($params['name'])) {
            $builder->where('name', 'like', '%' . request()->get('name') . '%');
        }
        if (!empty($params['gender'])) {
            $builder->where('gender',request()->get('gender'));
        }
        if (!empty($params['username'])) {
            $builder->where('username', 'like', '%' . request()->get('username') . '%');
        }
        if (!empty($params['tell'])) {
            $builder->where('tell', 'like', '%' . request()->get('tell') . '%');
        }
        if (!empty($params['state'])) {
            $builder->where('state',request()->get('state'));
        }
        return $builder;
    }

}
