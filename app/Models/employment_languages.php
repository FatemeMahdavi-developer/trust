<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class employment_languages extends Model
{
    use HasFactory,SoftDeletes;

    const UPDATED_AT = null;

    protected $guarded=[];
}
