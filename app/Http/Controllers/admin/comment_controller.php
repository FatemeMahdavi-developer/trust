<?php

namespace App\Http\Controllers\admin;

use App\base\class\admin_controller;
use App\Http\Controllers\Controller;
use App\Models\comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class comment_controller extends Controller
{
    use \App\Trait\Comment;
    private string $view = "";
    private string $module = "";
    private string $module_title = "";

    public function __construct()
    {
        $this->view = "admin.module.comment.";
        $this->module = "comment";
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
        $comment=comment::with('commentable')->filter($request->all())->orderby('id','desc')->paginate(5)->withQueryString();
        $modules=self::modules();
        return view($this->view.'list',[
            'module_title' => $this->module_title,
            'comment' => $comment,
            'modules' => $modules,
            'module'=>$this->module
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(comment $comment)
    {
        return view($this->view."edit",[
            'comment'=>$comment,
            'module_title'=>$this->module_title
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, comment $comment)
    {
        $request->validate([
            'response_note'=>'required'
        ]);
        $comment->update([
            'response_note'=>$request->response_note,
            'response_created_at'=>Carbon::now()
        ]);
        return back()->with('success', __('common.messages.success_edit', [
            'module' => $this->module_title
        ]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        comment::where('id', $id)->delete();
        return true;
    }


    public function action_all(Request $request){
        $filed_validation = ['item' => 'required'];
        $validator = Validator::make($request->all(), $filed_validation);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        return (new admin_controller())->action($request, comment::class);
    }



    public function modules(){
        $modules=[];
        foreach ($this->module_comment as $key => $value) {
            $modules[$value]=trans('modules.module_name.'.$value);
        }
        return $modules;
    }
}
