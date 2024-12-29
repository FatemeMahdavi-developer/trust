<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use function PHPUnit\Framework\stringContains;



class Authorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$permission_kind): Response
    {
        if(auth()->user()->id=="1" || auth()->user()->role->permission->select('permission_kind')->where('permission_kind',$permission_kind)->count()){
            return $next($request);
        }
        return abort(401);

    }
}
