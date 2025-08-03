<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpenLock extends Model
{
    use HasFactory;
    protected $table="open_locks";
    protected $guarded=[];
}
