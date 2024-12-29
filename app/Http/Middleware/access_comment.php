<?php

namespace App\Http\Middleware;

use App\Trait\Comment;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class access_comment
{
    use Comment;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!in_array($request->route()->parameters()['type'],$this->module_comment)){
            abort(404);
        }
        return $next($request);
    }
}
