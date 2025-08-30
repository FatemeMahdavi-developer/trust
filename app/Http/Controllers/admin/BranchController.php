<?php

namespace App\Http\Controllers\admin;

use App\base\class\admin_controller;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\BranchRequest;
use App\Models\Branch;
use App\Models\contactmap;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BranchController extends Controller
{
    public function __construct(private string $view = "", private string $module = '', private string $module_title = '')
    {
        $this->view = "admin.module.branch.";
        $this->module = "branch";
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
        $branch = Branch::filter($request->all())->paginate(5);
        return view($this->view . 'list', [
            'module_title' => $this->module_title,
            'module' => $this->module,
            'branch' => $branch,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $contactmap = contactmap::find('1');

        $users=User::where('locker_bank_owner',1)->select('id','name','lastname')->get();

        return view($this->view . 'new', [
            'contactmap' => $contactmap,
            'module_title' => $this->module_title,
            'module' => $this->module,
            'users'=>$users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BranchRequest $request)
    {
        $input=$request->validated();

        $input['admin_id']=Auth::user()->id;

        Branch::create($input);

        return back()->with('success', __('common.messages.success', [
            'module' => $this->module_title
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $branch = Branch::find($id);
        $users=User::where('locker_bank_owner',1)->select('id','name','lastname')->get();

        return view($this->view . 'edit', [
            'module_title' => $this->module_title,
            'module' => $this->module,
            'branch' =>$branch,
            'users'=>$users
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BranchRequest $request, branch $branch)
    {
        $input=$request->validated();

        $branch->update($input);

        return back()->with('success', __('common.messages.success_edit', [
            'module' => $this->module_title,
        ]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Branch::where('id', $id)->delete();
        return true;
    }
    public function action_all(Request $request)
    {
        $filed_validation = ['item' => 'required'];
        $validator = Validator::make($request->all(), $filed_validation);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        return (new admin_controller())->action($request, Branch::class);
    }
}
