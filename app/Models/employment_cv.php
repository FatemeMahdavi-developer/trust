<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class employment_cv extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded=[];

    const UPDATED_AT=null;

    public $table="employment_cv";

    
}
