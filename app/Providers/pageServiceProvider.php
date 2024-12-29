<?php

namespace App\Providers;

use App\Models\page;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class pageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

//        View::composer(["site.*"],function(){
//            global $page;
//        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        page::where("state", "1")->each(function ($page) {
            View::composer(["site.*"], function ($view) use ($page) {
                $filleds = ["title", "pic", "alt_pic", "note"];
                foreach ($filleds as $filled) {
                    $view->with(["pages_" . $page["seo_url"] . "_".$filled => $page[$filled]]);
                }
            });
        });

    }
}
