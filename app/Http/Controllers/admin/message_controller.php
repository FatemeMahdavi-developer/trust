<?php
namespace App\Http\Controllers\admin;
use App\base\class\admin_controller;
use App\Http\Controllers\Controller;
use App\Models\message;
use App\Models\message_cat;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class message_controller extends Controller
{
    public function __construct(private string $view='',private string $module ='',private string $module_title ='')
    {
        $this->module = "message";
        $this->view = "admin.module.".$this->module.".";
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
        $message = message::with('message_cat')->filter($request->all())->paginate(4);
        $message_cats_search = message_cat::with(['sub_cats'])->where('catid', '0')->get();
        return view($this->view . "list", [
            'module_title' => $this->module_title,
            'message_cats_search' => $message_cats_search,
            'message' => $message
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(message $message)
    {
        $message_cats = message_cat::where('catid','0')->with('sub_cats')->get();
        return view($this->view . "edit", [
            'module_title' => $this->module_title,
            'message_cats' => $message_cats,
            'message' => $message,
            'module' => $this->module,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(message_request $request, message $message)
    // {
    //     $validity_date = Carbon::now()->format("Y/m/d");
    //     if (!empty($request->validity_date[0])) {
    //         $validity_date = $this->convert_date_to_timestamp($request->validity_date);
    //     }
    //     $message->update([
    //         'catid' => $request->catid,
    //         'note' => $request->note,
    //         'note_more' => $request->note_more,
    //     ]);
    //     return back()->with('success', __('common.messages.success_edit', [
    //         'module' => $this->module_title
    //     ]));
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        message::where('id', $id)->delete();
        return true;
    }
    public function action_all(Request $request)
    {
        $filed_validation = ['item' => 'required'];
        $validator = Validator::make($request->all(), $filed_validation);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        return (new admin_controller())->action($request, message::class);
    }
}
