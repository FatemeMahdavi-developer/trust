<?php

namespace App\Http\Controllers\admin;

use App\base\class\admin_controller;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\instagram_request;
use App\Models\instagram;
use App\Trait\ResizeImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class instagramController extends Controller
{
    use ResizeImage;
    public function __construct(private string $view = "", private string $module = '', private string $module_title = '')
    {
        $this->view = "admin.module.instagram.";
        $this->module = "instagram";
        $this->module_title = __("modules.module_name." . $this->module);

        foreach (trans("modules.crud_authorize") as $key => $value) {
            $authorize_name=sprintf("authorize:%s_%s",$key,$this->module);
            $this->middleware($authorize_name)->only($value);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $instagram = instagram::filter($request->all())->paginate(5);
        return view($this->view . 'list', [
            'module_title' => $this->module_title,
            'module' => $this->module,
            'instagram' => $instagram,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view($this->view . 'new', [
            'module_title' => $this->module_title,
            'module' => $this->module
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(instagram_request $request)
    {
        DB::beginTransaction();
        $pic=$this->upload_file($this->module,'pic');
        instagram::create([
            'title'=>$request->title,
            'alt_pic'=>$request->alt_pic,
            'link'=>$request->link,
            'pic'=>$pic
        ]);
        DB::commit();
        return back()->with('success', __('common.messages.success', [
            'module' => $this->module_title
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $instagram = instagram::find($id);
        return view($this->view . 'edit', [
            'module_title' => $this->module_title,
            'module' => $this->module,
            'instagram' =>$instagram,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(instagram_request $request, instagram $instagram)
    {
        DB::beginTransaction();
        $pic=$this->upload_file($this->module,'pic');
        $instagram->update([
            'title'=>$request->title,
            'alt_pic'=>$request->alt_pic,
            'link'=>$request->link,
            'pic'=>$pic
        ]);
        DB::commit();
        return back()->with('success', __('common.messages.success_edit', [
            'module' => $this->module_title
        ]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        instagram::where('id', $id)->delete();
        return true;
    }
    public function action_all(Request $request)
    {
        $filed_validation = ['item' => 'required'];
        $validator = Validator::make($request->all(), $filed_validation);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        return (new admin_controller())->action($request, instagram::class);
    }
}
