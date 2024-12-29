<?php

namespace App\Models;

use App\Trait\date_convert;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Trait\admin;
class permissions extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=["title","role"];
    // protected $appends=["title_fa"];
    protected $appends=["permission_kind","title_fa"];


    public function getTitleFaAttribute(){
        return trans("modules.crud.".$this->title)." ".trans("modules.module_name.".$this->module);
    }

    public function getPermissionKindAttribute(){
        return $this->title."_".$this->module;
    }

}
