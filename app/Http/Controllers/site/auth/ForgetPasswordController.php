<?php

namespace App\Http\Controllers\site\auth;

use App\Http\Controllers\Controller;
use App\Mail\confirmActive;
use App\Mail\forget_pass;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use function back;

class ForgetPasswordController extends Controller
{
    public function __construct(public string $module='',public string $module_title='',public string $module_pic='')
    {
        $this->module="forgot-password";
        $this->module_title=app('setting')->get($this->module."_title") ? app('setting')->get($this->module."_title") : trans("modules.module_name_site.".$this->module);
        $this->module_pic=app('setting')->get($this->module."_pic") ?? '';
    }

    public function change_pass()
    {
        $username = decode_string(request()->get('username')) ?? '';
        return view(
            'site.auth.forget-password',
            compact('username'),
            ['module_pic'=>$this->module_pic,'module_title'=>$this->module_title] 
        );
    }

    public function send_form(Request $request)
    {
        $request->validate([
            'username' => ['required', 'min:1', 'max:255', 'exists:users,username']
        ]);
        $user = \App\Models\User::where('username', $request->username)->first();
        if(!$user["state"]){
            $user->update(['confirm_code'=>rand(10000, 99999),'expire_confirm_at'=>Carbon::now()->addSeconds(env('EXPIRE_DATE_CONFIRM_CODE'))]);
            $fullname = $user['name'] . " " . $user['lastname'];
            Mail::to($user['username'])->send(new confirmActive($fullname, $user['confirm_code']));
            return redirect()->route('auth.active',['username'=>code_string($request->username)]);
        }
        $code = rand(10000, 99999);
        $fullname = $user['name'] . " " . $user['lastname'];
        Mail::to($request->username)->send(new forget_pass($fullname, $code));
        $user->update(['confirm_code' => $code, 'expire_confirm_at' => Carbon::now()->addSeconds(env('EXPIRE_DATE_CONFIRM_CODE'))]);
        return redirect()->route('auth.recovery-password', ['username' => code_string($request->get('username'))]);
    }

    public function recovery_pass()
    {
        $username = decode_string(request()->get('username')) ?? '';
        return view(
            'site.auth.recovery_password', 
            compact('username'),
            ['module_pic'=>$this->module_pic,'module_title'=>$this->module_title] 
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => ['required', 'min:1', 'max:255', 'exists:users,username'],
            'confirm_code' => ['required', 'min:1'],
            'password' => ['required', 'string', 'min:1', 'max:255', 'confirmed'],
        ], ['username.exists' => 'این نام کاربری وجود ندارد']);
        $user = User::where('username', $request->get('username'))->where('confirm_code', $request->confirm_code)->where('state', '1')->first();

        if(is_null($user)){
            throw ValidationException::withMessages([
                'username' => trans('auth.failed'),
            ]);
        }
        $user->update([
            'password'=>Hash::make($request->get('password'))
        ]);
        Auth::login($user);
        return redirect()->route('user.panel');
    }
}
