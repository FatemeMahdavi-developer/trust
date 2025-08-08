<?php

namespace App\Http\Controllers\admin;

use App\base\class\admin_controller;
use App\Base\Entities\Enums\SizeLocker;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\LockerBankRequest;
use App\Models\Branch;
use App\Models\LockerBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use function App\Helpers\admin\enumAsOptions;

class LockerBankController extends Controller
{
    public function __construct(private string $view = "", private string $module = '', private string $module_title = '')
    {
        $this->view = "admin.module.locker_bank.";
        $this->module = "locker_bank";
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
        $lockerBank = LockerBank::filter($request->all())->paginate(5);
        $branches=Branch::all();
        $size=collect(enumAsOptions(SizeLocker::cases(),app(LockerBank::class)->enumsLang()))->pluck('label','value');
        return view($this->view . 'list', [
            'module_title' => $this->module_title,
            'module' => $this->module,
            'branches' => $branches,
            'size' => $size,
            'lockerBank' => $lockerBank,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches=Branch::all();
        $size=collect(enumAsOptions(SizeLocker::cases(),app(LockerBank::class)->enumsLang()))->pluck('label','value');
        return view($this->view . 'new', [
            'module_title' => $this->module_title,
            'module' => $this->module,
            'size'=>$size,
            'branches' => $branches
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LockerBankRequest $request)
    {

        $url = sprintf(config('qrcode.qrcode.url'),env("APP_URL"),$request->code);

        $imageContents = Http::get($url)->body();

        $directory = public_path('qrcodes');
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $filename = time() . '.png';

        $filePath = $directory . DIRECTORY_SEPARATOR . $filename;

        file_put_contents($filePath, $imageContents);
        LockerBank::create([
            'code'=>$request->code,
            'size'=>$request->size,
            'qrcode'=>'qrcodes/' . $filename,
            'branch_id'=>$request->branch_id
        ]);
        return back()->with('success', __('common.messages.success', [
            'module' => $this->module_title,
       ]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $branches=Branch::all();
        $size=collect(enumAsOptions(SizeLocker::cases(),app(LockerBank::class)->enumsLang()))->pluck('label','value');
        $lockerBank = LockerBank::find($id);
        return view($this->view . 'edit', [
            'module_title' => $this->module_title,
            'module' => $this->module,
            'lockerBank' =>$lockerBank,
            'size'=>$size,
            'branches' => $branches
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LockerBankRequest $request, lockerBank $lockerBank)
    {
        $input=$request->validated();
        $url = sprintf(config('qrcode.qrcode.url'),env("APP_URL"),$input['code']);

        $imageContents = Http::get($url)->body();

        $directory = public_path('qrcodes');
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $filename = time() . '.png';

        $filePath = $directory . DIRECTORY_SEPARATOR . $filename;
        file_put_contents($filePath, $imageContents);

        $lockerBank->update($input);

        return back()->with('success', __('common.messages.success_edit', [
            'module' => $this->module_title
        ]));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        LockerBank::where('id', $id)->delete();
        return true;
    }
    public function action_all(Request $request)
    {
        $filed_validation = ['item' => 'required'];
        $validator = Validator::make($request->all(), $filed_validation);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        return (new admin_controller())->action($request, LockerBank::class);
    }
}
