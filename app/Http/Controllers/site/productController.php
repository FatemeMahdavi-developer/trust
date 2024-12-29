<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Mail\share;
use App\Models\product;
use App\Models\product_cat;
use App\Trait\seo_site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Calculation\Financial\Securities\Rates;

class productController extends Controller
{
   use seo_site;
   public function __construct(private string $module='',private string $module_title='')
   {
       $this->module="product";
       $this->module_title=trans("modules.module_name_site.".$this->module);
   }

   public function index(product_cat $product_cat = null)
   {
       $module=$this->module;
       $module_title=$this->module_title;
       $breadcrumb=[];
       $params=request()->all();

       $product_cats = product_cat::where(['catid'=>'0','state'=>'1'])
           ->with('sub_cats_site')
           ->orderByRaw("`order` ASC, `id` DESC")
           ->get();

       if ($product_cat != null) {
           if (!$product_cat->state){
               abort(404);
           }
           $breadcrumb=$product_cat->parents()->where('state','1');
           $params['catid']=$product_cat->getSubcatIds($product_cat->id);;

           $product=product::siteFilter($params)
               ->paginate(5)
               ->withQueryString();

       }else{
           $product = product::siteFilter($params)
           ->paginate(5)
           ->withQueryString();
       }

       $seo=$this->seo_site($this->module,$product_cat);

       return view('site.product', compact('product_cat','product','product_cats','breadcrumb','module_title','seo','module'));
   }

   public function show(Request $request, product $product){
       $module_title=$this->module_title;
       $module=$this->module;
       $comment = $product->comment()->where("state", "1")->orderBy("id","DESC")->paginate(4);
       if ($request->ajax()) {
           return view("site.layout.partials.comment",compact('comment'));
       } else {
           if (!$product->state)
               abort(404);
           if (str_contains(request()->url(), '/print')) {
               return view('site.print.product_info', compact('product'));
           }
           $breadcrumb=$product->product_cat->parents()->where('state','1');
           $content=$product->content()->where('state','1')
               ->orderByRaw("`order` ASC,`id` DESC")
               ->get(['title','pic','kind','catalog']);

           $content_pics=$content->where('kind',3);
           $content_catalog=$content->where('kind',4)->first(); 
           
           $seo=$this->seo_site($this->module,$product);

            return view('site.product_info',
                compact('product',
                    'comment',
                    'content_pics',
                    'content_catalog',
                    'breadcrumb',
                    'seo',
                    'module',
                    'module_title'
                )
            );
       }
   }

   public function mail(Request $request, $id)
   {
       $product = product::findOrFail($id);
       $validation = Validator::make($request->all(), [
           'email' => 'required|email|min:1|max:255'
       ]);
       if ($validation->fails()) {
           return response()->json($validation->errors());
       }
       Mail::to($request->email)->send(new share($product['title'], $product['url']));
       return response()->json([
           'success' => __('common.messages.email_success')
       ]);
   }
}
