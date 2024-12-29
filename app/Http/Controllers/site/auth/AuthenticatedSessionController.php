<?php

namespace App\Http\Controllers\site\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Mail\confirmActive;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use function redirect;
use function view;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        $module="login";
        $module_title=app('setting')->get($module."_title") ? app('setting')->get($module."_title") : trans("modules.module_name_site.".$module);
        $module_pic=app('setting')->get($module."_pic");

        return view('site.auth.login',compact(['module_title','module_pic']));
    }


    public function authenticateUserName(Request $request)
    {
        $user = User::where('username', $request->username)->first();
        if (!is_null($user)) {
            if ($user["state"]) {
                return redirect()->route('auth.login', ['username' => code_string($request->username)]);
            }
            $user->update(['confirm_code'=>rand(10000, 99999),'expire_confirm_at'=>Carbon::now()->addSeconds(env('EXPIRE_DATE_CONFIRM_CODE'))]);
            $fullname = $user['name'] . " " . $user['lastname'];
            Mail::to($user['username'])->send(new confirmActive($fullname, $user['confirm_code']));
            return redirect()->route('auth.active', ['username' => code_string($request->username)]);
        } else {
//            throw ValidationException::withMessages([
//                'username' => trans('auth.failed'),
//            ]);
            return redirect()->route('auth.register')->with('wrong_username', trans('auth.wrong_username'));
        }
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
        Auth::login(User::where('username', decode_string(request()->get('username')))->first());
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
