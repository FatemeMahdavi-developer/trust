<?php

namespace App\Http\Middleware;

use App\Trait\Like;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class access_like
{
    use Like;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!in_array($request->route()->parameters()['type'],$this->module_like)){
            abort(404);
        }
        return $next($request);
    }
}
