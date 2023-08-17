<?php

namespace App\Http\Middleware;
use Illuminate\Support\Str;
use Closure;

class Bearer
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
    public function handle($request, Closure $next)
    {
        $header = $request->header('Authorization');
        if (Str::startsWith($header, 'Bearer '))
        {
            return $next($request);
        }
        return response()->json(['status'=>0,'message' =>['Bearer Unidentified']], 403);

    }
}
