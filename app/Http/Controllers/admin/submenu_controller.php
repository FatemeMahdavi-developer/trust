<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\menu;
use Illuminate\Http\Request;

class submenu_controller extends Controller
{
    public function __invoke()
    {
        $menu=menu::where('catid','0')->where('type',request()->get('type'))->get();
        $html = view(config("component_prefix").'select_recursive', [
             'name'=>'catid',
             'options' => $menu,
             'label' => 'بخش',
             'first_option' => 'بخش اصلی',
             'sub_method' => 'sub_menus',
             'value' => request()->get('catid'),
             'class' => 'w-50 show_catid'
         ])->render();
         return $html;
    }
}