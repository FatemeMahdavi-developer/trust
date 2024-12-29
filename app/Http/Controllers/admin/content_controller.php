<?php

namespace App\Http\Controllers\admin;

use App\base\class\admin_controller;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\content_request;
use App\Models\content;
use App\Models\news;
use App\Models\page;
use App\Models\product;
use App\Trait\ResizeImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class content_controller extends Controller
{

    use ResizeImage;

    private string $view = "";
    private string $module = "";
    private string $module_title = "";

    public function __construct()
    {
        $this->view = "admin.module.content.";
        $this->module = "content";
        $this->module_title = __("modules.module_name." . $this->module);

        foreach (trans("modules.crud_authorize") as $key => $value) {
            $authorize_name=sprintf("authorize:%s_%s",$key,$this->module);
            $this->middleware($authorize_name)->only($value);
        }
    }

    public function create($item_id, $module)
    {
        $content_kind = __("common.content." . $module);
        return view($this->view . "new", [
            'module_title' => $this->module_title,
            'content_kind' => $content_kind,
            'item_id' => $item_id,
            'module_type' => $module,
            'module' => $this->module,
        ]);
    }

    public function store(content_request $request, $item_id, $module)
    {
        DB::beginTransaction();
        $module_content = self::modal_content()[$module];
        $contentable = $module_content::findOrFail($item_id);
        $pic = '';
        $catalog = '';
        $video = '';
        $pic_video = '';
        if ($request->kind == "2" && $request->pic) {
            $pic = $this->upload_file($this->module . "_" . $module, 'pic');
        }
        if ($request->kind == "4") {
            $catalog = $this->upload_file($this->module . "_" . $module, 'catalog');
        }
        if ($request->kind == "5" && $request->is_aparat != "1") {
            $video = $this->upload_file($this->module . "_" . $module, 'video');
            $pic_video = $this->upload_file($this->module . "_" . $module, 'pic_video');
        }

        if ($request->kind == "3") {
            foreach ($request->pics as $key => $value){
                $pic = $this->upload_multiple_file($this->module . "_" . $module, 'pics',$key);
                $contentable->content()->create([
                    'title' => $request->title,
                    'kind' => $request->kind,
                    'pic' => $pic,
                ]);
            }
        }else{
            $contentable->content()->create([
                'title' => $request->title,
                'kind' => $request->kind,
                'note' => $request->note,
                'pic' => $pic,
                'is_aparat' => $request->is_aparat,
                'catalog' => $catalog,
                'video' => $video,
                'pic_video' => $pic_video,
                'note_more' => $request->note_more,
            ]);
        }


        DB::commit();
        return back()->with('success', __('common.messages.success', [
            'module' => $this->module_title
        ]));
    }


    public function list(Request $request, $item_id, $module)
    {
        $module_content = self::modal_content()[$module];
        $model = $module_content::findOrFail($item_id);
        $content = $model->content()->filter($request->all())->paginate(10)->withQueryString();
        $content_kind = __("common.content." . $module);

        return view($this->view . "list", [
            'module_title' => $this->module_title,
            'item_id' => $item_id,
            'module_type' => $module,
            'module' => $this->module,
            'model' => $model,
            'content' => $content,
            'content_kind' => $content_kind,
        ]);
    }

    public function destroy(string $id)
    {
        content::where('id', $id)->delete();
        return true;
    }

    public function action_all(Request $request)
    {
        $filed_validation = ['item' => 'required'];
        $validator = Validator::make($request->all(), $filed_validation);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        return (new admin_controller())->action($request, content::class);
    }

    public function edit($item_id, $module)
    {
        $content = content::where("id", $item_id)->where("contentable_type", self::modal_content()[$module])->firstOrFail();
        return view($this->view . "edit", [
            'module_title' => $this->module_title,
            'item_id' => $item_id,
            'module_type' => $module,
            'module' => $this->module,
            'content' => $content,
        ]);
    }

    public function update(content_request $request, $item_id, $module)
    {
        DB::beginTransaction();
        $content_item = content::where('kind', $request->kind)->where("contentable_type", self::modal_content()[$module])->where('id', $item_id)->firstOrFail();
        $pic = '';
        $catalog = '';
        $video = '';
        $pic_video = '';
        if ($content_item['kind'] == "2") {
            $pic = $this->upload_file($this->module . "_" . $module, 'pic');
        }
        if ($content_item['kind'] == "3") {
            $pic = $this->upload_file($this->module . "_" . $module, 'pics');
        }
        if ($content_item['kind'] == "4") {
            $catalog = $this->upload_file($this->module . "_" . $module, 'catalog');
        }
        if ($content_item['kind'] == "5" && $request->is_aparat != "1") {
            $request->note_more = "";
            $video = $this->upload_file($this->module . "_" . $module, 'video');
            $pic_video = $this->upload_file($this->module . "_" . $module, 'pic_video');
        }
        content::find($item_id)->update([
            'title' => $request->title,
            'note' => $request->note,
            'pic' => $pic,
            'is_aparat' => $request->is_aparat,
            'catalog' => $catalog,
            'video' => $video,
            'pic_video' => $pic_video,
            'note_more' => $request->note_more,
        ]);

        DB::commit();
        return back()->with('success', __('common.messages.success_edit', [
            'module' => $this->module_title
        ]));

    }


    private function modal_content()
    {
        return [
            'news' => news::class,
            'product' => product::class,
            'page' => page::class,
        ];
    }
}
