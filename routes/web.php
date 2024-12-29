<?php

use App\Http\Controllers\admin\product_controller;
use App\Http\Controllers\admin\province_city_controller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\site\ContactController;
use App\Http\Controllers\site\EmploymentController;
use App\Http\Controllers\site\MultimediaController;
use App\Http\Controllers\site\newsController;
use App\Http\Controllers\site\PhotoController;
use App\Http\Controllers\site\productController;
use App\Http\Controllers\site\searchController;
use App\Http\Controllers\site\VideoController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Route::prefix(LaravelLocalization::setLocale())->middleware(['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'])->group(function () {
    
    require __DIR__ . '/auth.php';
    
    Route::any('search',searchController::class)->name('search');

    Route::get('', [\App\Http\Controllers\site\HomeController::class, 'main'])->name('main');

    Route::get('about', [\App\Http\Controllers\site\HomeController::class, 'about'])->name('about');

    Route::prefix('/news')->as('news.')->group(function () {
        Route::get('/', [newsController::class, 'index'])->name('index');
        Route::get('/cat/{news_cat:seo_url}', [newsController::class, 'index'])->name('index_cat');
        Route::get('/{news:seo_url}', [newsController::class, 'show'])->name('show');
        Route::post('/news_send_email/{id}', [newsController::class, 'mail'])->name('mail');
        Route::get('/{news:seo_url}/print', [newsController::class, 'show'])->name('print');
    });

    Route::prefix('/product')->as('product.')->group(function () {
        Route::get('/', [productController::class,'index'])->name('index');
        Route::get('/cat/{product_cat:seo_url}',[productController::class,'index'])->name('index_cat');
        Route::get('/{product:seo_url}',[productController::class,'show'])->name('show');
        Route::post('/product_send_email/{id}',[productController::class,'mail'])->name('mail');
        Route::get('/{product:seo_url}/print',[productController::class,'show'])->name('print');
    });

    Route::prefix('comment/{type}/{module_id}')->middleware('auth')->middleware('access')->as('comment.')->group(function () {
        Route::post('/store', [\App\Http\Controllers\site\user\commentController::class, 'store'])->name('store');
    });
    Route::post('rate/{module}/{item_id}', [\App\Http\Controllers\site\RateController::class, 'store'])->name("rate")->middleware('auth');
    Route::get('pages/{pages}', [\App\Http\Controllers\site\pageController::class, 'page'])->name("page");
    //Route::get('/show/{model}',[\App\Http\Controllers\site\user\commentController::class,'show'])->name('comment.show');

    Route::get('contact', [ContactController::class,'contact'])->name('contact');


    Route::post("contact",[ContactController::class,'store'])->name('contact.store');


    Route::get('/multimedia', [MultimediaController::class,'index'])->name('multimedia.index');

    Route::prefix('/photo')->as('photo.')->group(function () {
        Route::get('/', [PhotoController::class, 'index'])->name('index');
        Route::get('/cat/{photo_cat:seo_url}',[PhotoController::class,'index'])->name('index_cat');
    });
    Route::prefix('/video')->as('video.')->group(function () {
        Route::get('/', [VideoController::class, 'index'])->name('index');
        Route::get('/cat/{video_cat:seo_url}',[VideoController::class,'index'])->name('index_cat');
        Route::get('/{video:seo_url}', [VideoController::class,'show'])->name('show');
    });

    Route::post("province_city", province_city_controller::class)->name("province_city");


    Route::get('/employment', [EmploymentController::class,'show'])->name('employment.show');
    Route::post('/employment', [EmploymentController::class,'store'])->name('employment.store');

    // Route::get('/sitemap.xml');

    
// });