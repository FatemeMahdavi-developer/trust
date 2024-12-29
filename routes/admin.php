<?php

use App\Http\Controllers\admin\bannerController;
use App\Http\Controllers\admin\comment_controller;
use App\Http\Controllers\admin\ContactMapController;
use App\Http\Controllers\admin\content_controller;
use App\Http\Controllers\admin\employment_controller;
use App\Http\Controllers\admin\employment_section_controller;
use App\Http\Controllers\admin\instagramController;
use App\Http\Controllers\admin\manager_controller;
use App\Http\Controllers\admin\menuController;
use App\Http\Controllers\admin\message_cat_controller;
use App\Http\Controllers\admin\message_controller;
use App\Http\Controllers\admin\news_cat_controller;
use App\Http\Controllers\admin\news_controller;
use App\Http\Controllers\admin\permission_controller;
use App\Http\Controllers\admin\premission;
use App\Http\Controllers\admin\product_cat_controller;
use App\Http\Controllers\admin\product_controller;
use App\Http\Controllers\admin\province_city_controller;
use App\Http\Controllers\admin\roleController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\pagesController;
use App\Http\Controllers\admin\photo_cat_controller;
use App\Http\Controllers\admin\photo_controller;
use App\Http\Controllers\admin\submenu_controller;
use App\Http\Controllers\admin\video_cat_controller;
use App\Http\Controllers\admin\video_controller;
use Illuminate\Support\Facades\Redirect;
use \Illuminate\Support\Facades\Route;

include "auth_admin.php";

Route::middleware("auth:admin")->group(function () {
    Route::redirect('/','/'.env('ADMIN_PREFIX').'/base');
    Route::view("/base", "admin.layout.base")->name("admin.base");
    Route::view("/error", "admin.layout.errors.404")->name("admin.error404");
    Route::post("province_city", province_city_controller::class)->name("province_city");
    Route::resource("news_cat", news_cat_controller::class)->except("show");
    Route::post("news_cat/action_all", [news_cat_controller::class, "action_all"])->name("news_cat.action_all");
    Route::resource("news", news_controller::class)->except("show");
    Route::post("news/action_all", [news_controller::class, "action_all"])->name("news.action_all");
    Route::resource("manager", manager_controller::class)->except("show");
    Route::post("manager/action_all", [manager_controller::class, "action_all"])->name("manager.action_all");
    Route::resource("comment", comment_controller::class)->except("show","store","create");
    Route::post("comment/action_all", [comment_controller::class, "action_all"])->name("comment.action_all");
    Route::resource("banner", bannerController::class);
    Route::post("banner/action_all", [bannerController::class, "action_all"])->name("banner.action_all");
    Route::prefix("content/{item_id}/{module}/")->as("content.")->group(function () {
        Route::get("create", [content_controller::class, 'create'])->name("create");
        Route::post("store", [content_controller::class, 'store'])->name("store");
        Route::get("list", [content_controller::class, 'list'])->name("list");
        Route::post("action_all", [content_controller::class, "action_all"])->name("action_all");
        Route::delete("destroy", [content_controller::class, "destroy"])->name("destroy");
        Route::get("edit", [content_controller::class, 'edit'])->name("edit");
        Route::post("update", [content_controller::class, 'update'])->name("update");
    });
    Route::resource("comment", comment_controller::class)->except("show","store","create");
    Route::resource("instagram", instagramController::class);
    Route::post("instagram/action_all", [instagramController::class, "action_all"])->name("instagram.action_all");

    Route::resource("menu", menuController::class);
    Route::post("menu/action_all", [menuController::class, "action_all"])->name("menu.action_all");
    Route::post("menu/submenu",submenu_controller::class)->name("menu.submenu");

    Route::resource("product_cat",product_cat_controller::class)->except("show");
    Route::post("product_cat/action_all",[product_cat_controller::class,"action_all"])->name("product_cat.action_all");


    Route::resource("product",product_controller::class)->except("show");
    Route::post("product/action_all",[product_controller::class,"action_all"])->name("product.action_all");

    Route::resource("user",UserController::class)->except("show","create","store");
    Route::post("user/action_all",[UserController::class,"action_all"])->name("user.action_all");

    Route::resource("page",pagesController::class)->except("show");
    Route::post("page/action_all",[pagesController::class,"action_all"])->name("page.action_all");

    Route::resource("role",roleController::class)->except("show");
    Route::post("role/action_all",[roleController::class,"action_all"])->name("role.action_all");


    Route::get("setting",[\App\Http\Controllers\admin\settingController::class,"setting"])->name("setting");
    Route::post("setting",[\App\Http\Controllers\admin\settingController::class,"store"])->name("setting.store");

    Route::prefix('contactmap')->as("contactmap.")->group(function () {
        Route::get("",[ContactMapController::class,'edit'])->name("edit");
        Route::put("",[ContactMapController::class,'update'])->name("update");
    });
    Route::resource("contact/message_cat",message_cat_controller::class)->except("show");
    Route::post("contact/message_cat/action_all",[message_cat_controller::class,"action_all"])->name("message_cat.action_all");

    Route::resource("contact/message",message_controller::class)->except("show",'create','store');
    Route::post("contact/message/action_all",[message_controller::class,"action_all"])->name("message.action_all");

    
    Route::resource("photo_cat",photo_cat_controller::class)->except("show");
    Route::post("photo_cat/action_all", [photo_cat_controller::class, "action_all"])->name("photo_cat.action_all");
    Route::resource("photo",photo_controller::class)->except("show");
    Route::post("photo/action_all", [photo_controller::class, "action_all"])->name("photo.action_all");

    Route::resource("video_cat",video_cat_controller::class)->except("show");
    Route::post("video_cat/action_all",[video_cat_controller::class,"action_all"])->name("video_cat.action_all");
    Route::resource("video",video_controller::class)->except("show");
    Route::post("video/action_all", [video_controller::class, "action_all"])->name("video.action_all");

    // *** employment
    Route::resource("employment_section",employment_section_controller::class)->except("show");
    Route::post("employment_section/action_all",[employment_section_controller::class,'action_all'])->name("employment_section.action_all");
    Route::resource('employment',employment_controller::class)->except(['show','create','store','update']);
    Route::post("employment/action_all",[employment_controller::class,'action_all'])->name('employment.action_all');
    Route::get('employment/excel',[employment_controller::class,'excel'])->name('employment.excel');
    Route::get('/employment/{id:id}/print', [employment_controller::class,'print'])->name('employment.print');
    // employment ***

});
