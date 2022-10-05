<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Hash;

class PasswordCheck
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
        if (!Hash::check($request->password, auth('api')->user()->password)) {
            return response()->json([
                'message' => "비밀번호가 일치하지 않습니다."
            ]);
        }else{
            return $next($request);
        }
    }
}
