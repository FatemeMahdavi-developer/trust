<?php

namespace App\Http\Controllers\admin;

use App\base\class\admin_controller;
use App\Exports\EmploymentExport;
use App\Http\Controllers\Controller;
use App\Models\employment;
use App\Models\employment_section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class employment_controller extends Controller
{

    public function __construct(private $module='',private $module_title='',private $view='')
    {
        $this->module='employment';
        $this->module_title=__('modules.module_name.'.$this->module);
        $this->view='admin.module.'.$this->module;
    }

    public function index(Request $request)
    {
        $employment_section=employment_section::get(['id','name'])->pluck('name','id');
        $employments=employment::filter($request->all())->orderby('id','desc')->paginate(5)->withQueryString();

        return view($this->view.'.list',[
            'module'=>$this->module,
            'module_title'=>$this->module_title,
            'employments'=>$employments,
            'employment_section'=>$employment_section
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // employment::where('id',$id)->update(['hit'=>'1']);  error update date_birth
        $employment=employment::find($id);
        return view($this->view.'.edit',[
            'module'=>$this->module,
            'module_title'=>$this->module_title,
            'employment'=>$employment
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        employment::findOrFail($id)->delete();
        return true;
    }

    public function action_all(Request $request)
    {
        $filed_validation = ['item' => 'required'];
        $validator = Validator::make($request->all(), $filed_validation);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        return (new admin_controller())->action($request, employment::class);
    }

    public function excel() 
    {
        return Excel::download(new EmploymentExport,'employment.xlsx');
    }
    
    public function print(int $id){
        $employment=employment::findOrFail($id);
        return view($this->view.'.print',compact('employment'));
    }
}
