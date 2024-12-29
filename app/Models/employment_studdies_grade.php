<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class employment_studdies_grade extends Model
{
    use HasFactory,SoftDeletes;
    public $table="employment_studdies_grade";

    const UPDATED_AT=null;

    protected $guarded=[];

}
