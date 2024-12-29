<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class employment_organization extends Model
{

    use HasFactory,SoftDeletes;
    
    public $table="employment_organization";
    const UPDATED_AT = null;

    protected $guarded=[];
}
