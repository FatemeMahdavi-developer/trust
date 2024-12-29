<?php

namespace App\Providers;

use App\Models\admin;
use App\Models\menu;
use App\Models\permissions;
use App\Models\product_cat;
use App\Models\province;
use App\Models\setting;
use App\Rules\ReCaptcha;
use App\Rules\subid_in_catid;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Pluralizer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        config()->set('component_prefix', 'components.admin.');
        View::composer(['admin.*', 'components.admin.*'], function ($view) {
            $view->with([
                'prefix_component' => 'components.admin.',
            ]);
        });
        Paginator::useBootstrapFour();

        View::composer(["site.auth.user.change_profile"], function ($view) {
            $view->with([
                'provinces' => province::all(),
                'genders' => trans("common.gender")
            ]);
        });
        View::composer(['site.layout.partials.header','site.layout.partials.footer'], function ($view) {
            $menu=menu::where('lang','1')->where('catid','0')->with('sub_menus_site')->where('state','1')
            ->orderByRaw("`order` ASC,`id` DESC")
            ->get(['id','title','type','pic','alt_pic','state','open_type','catid','url','select_page','pages']);

            $product_cat_submenu=product_cat::where('lang','1')->where('catid','0')->where('state','1')->where('state_menu','1')->with('sub_cats_site')->get();
            $view->with([
                'header_menu' =>$menu->where('type','1'),
                'procat_submenu'=>$product_cat_submenu,
                'footer_menu' =>$menu->where('type','2'),
            ]);
        });
        view()->composer('*', function ($view) {
            $view_name = str_replace('.', '-', $view->getName());
            view()->share('view_name', $view_name);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $setting=Setting::get();
        app()->bind('setting', function() use ($setting){
            return $setting->pluck('value', 'key');
        });
        config('setting',setting::pluck('value','key'));

        view()->composer('*', function ($view) {
            $view->with([
                'site_title' =>app("setting")->get("site_title") ?? '',
            ]);
        });

        permissions::get()->each(function ($permission) {
            Gate::define($permission["permission_kind"], function (admin $admin) use ($permission) {
                if ($admin["id"] == "1") {
                    return true;
                }
                return $admin->role->permission()->where("title", $permission["title"])->where("module", $permission["module"])->count();
            });
        });
    }


}
