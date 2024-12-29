<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Mail\share;
use App\Models\news;
use App\Models\news_cat;
use App\Trait\seo_site;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class newsController extends Controller
{
    use seo_site;
    public function __construct(private string $module='',private string $module_title='')
    {
        $this->module="news";
        $this->module_title=trans("modules.module_name_site.".$this->module);
    }

    public function index(news_cat $news_cat = null)
    {
        $module=$this->module;
        $module_title=$this->module_title;
        $breadcrumb=[];

        $news_cats=news_cat::where('state', '1')
            ->orderByRaw("`order` ASC, `id` DESC")
            ->get(['id', 'title', 'seo_url']);
            
        $hit_news = news::where('state','1')
            ->where('validity_date', '<=', Carbon::now()
            ->format('Y/m/d H:i:s'))
            ->orderByRaw("`order` ASC, `id` DESC")
            ->with(['news_cat'])
            ->select(['title', 'note', 'pic', 'catid', 'validity_date', 'alt_pic', 'seo_url'])
            ->orderByRaw("`hit` ASC, `id` DESC")
            ->get();

        $news = news::siteFilter()
            ->paginate(5)
            ->withQueryString();

        if ($news_cat != null) {
            if (!$news_cat->state)
                abort(404);

            if (!empty($news_cat->seo_redirect)) {
                $kind=!empty($news_cat["seo_redirect_kind"]) ? trans("common.redirect_kinds.".$news_cat["seo_redirect_kind"])  : 301;
                return Redirect::to($news_cat->seo_redirect,$kind );
            }
            $news = $news_cat->news()
                ->siteFilter()
                ->paginate(5)
                ->withQueryString();
            $breadcrumb=$news_cat->parents()->where('state','1');
        }
        $seo=$this->seo_site($this->module,$news_cat);
        return view('site.news', compact('news_cat', 'news', 'news_cats', 'hit_news','seo','breadcrumb','module_title','module'));
    }

    public function show(Request $request, news $news)
    {
        $comment = $news->comment()->where("state", "1")->paginate(4);
        if ($request->ajax()) {
            return view("site.layout.partials.comment",compact('comment'));
        } else {
            if (!$news->state)
                abort(404);
            if (str_contains(request()->url(), '/print')) {
                return view('site.print.news_info', compact('news'));
            }
            $seo=$this->seo_site($this->module,$news);
            return view('site.news_info', compact('news', 'comment','seo'));
        }
    }


    public function mail(Request $request, $id)
    {
        $news = news::findOrFail($id);
        $validation = Validator::make($request->all(), [
            'email' => 'required|email|min:1|max:255'
        ]);
        if ($validation->fails()) {
            return response()->json($validation->errors());
        }
        Mail::to($request->email)->send(new share($news['title'], $news['url']));
        return response()->json([
            'success' => __('common.messages.email_success')
        ]);
    }


}
