<?php

namespace App\Http\Controllers\site\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\site\RegisterUser;
use App\Mail\confirmActive;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

use function App\Helpers\admin\sms;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $module="register";
        $module_title=app('setting')->get($module."_title") ? app('setting')->get($module."_title") : trans("modules.module_name_site.".$module);
        $module_pic=app('setting')->get($module."_pic");
        return view('site.auth.register',compact(['module_title','module_pic']));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterUser $request): RedirectResponse
    {
        $user = User::where('username', $request->username)->first(['state','username','confirm_code','lastname','name']);
        if (!is_null($user)) {
            if ($user["state"] == "1") {
                return redirect()->route('auth.login')->with(['user_login' => trans('auth.user_login')]);
            }
            $fullname = $user['name'] . " " . $user['lastname'];

            $replacements = [
                '#fullname#'=>$fullname,
                '#code#'=>$user['confirm_code'],
            ];
            $text=str_replace(array_keys($replacements),array_values($replacements),app("setting")["confirm_msg_pattern_sms"]);
            sms($user['username'],$text);
            // Mail::to($user['username'])->send(new confirmActive($fullname, $user['confirm_code']));

            $user->update(['expire_confirm_at'=>Carbon::now()->addSeconds(env('EXPIRE_DATE_CONFIRM_CODE'))]);
            return redirect()->route('auth.active', ['username' => code_string($user['username'])])->with(['state_active' => trans('auth.state_active')]);
        }
        $code = rand(10000, 99999);
        User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'username' => $request->username,
            'expire_confirm_at' => Carbon::now()->addSeconds(env('EXPIRE_DATE_CONFIRM_CODE')),
            'password' => Hash::make($request->password),
            'confirm_code' => $code,
        ]);
        $fullname = $request->name . " " . $request->lastname;

        $replacements = [
            '#fullname#' => $fullname,
            '#code#'     => $code,
        ];
        $text=str_replace(array_keys($replacements),array_values($replacements),app("setting")["confirm_msg_pattern_sms"]);
        sms($request->username,$text);
        // Mail::to($request->username)->send(new confirmActive($fullname, $code));

        return redirect()->route('auth.active', ['username' => code_string($request->username)]);
    }

}
