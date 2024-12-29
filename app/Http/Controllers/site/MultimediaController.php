<?php
namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Models\gallery;
use App\Models\gallery_cat;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class MultimediaController extends Controller
{
    public function __construct(private string $module='',private string $module_title='')
    {
        $this->module="multimedia";
        $this->module_title=trans("modules.module_name_site.".$this->module);
    }

    public function index()
    {
        $gallery_cats = gallery_cat::siteFilter()->paginate(5)->withQueryString();
        return view('site.multimedia',[
            'module_title'=> $this->module_title,
            'gallery_cats'=>$gallery_cats
        ]);
    }

}
