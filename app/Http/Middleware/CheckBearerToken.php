<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class CheckBearerToken
{
    protected $validToken = '2BH52wAHrAymR7wP3CASt';

    public function handle(Request $request, Closure $next)
    {
        $ip = $request->ip();
        $bearerToken = $request->bearerToken();

       
        if ($bearerToken === $this->validToken) {
         
            Cache::forget('blacklist_'.$ip);
            Cache::forget('failed_attempts_'.$ip);
            return $next($request);
        }

      
        if (!$bearerToken) {
            // IP için başarısız istek sayısını artır
            $attempts = Cache::get('failed_attempts_'.$ip, 0) + 1;
            Cache::put('failed_attempts_'.$ip, $attempts, now()->addMinutes(10));

         
            if ($attempts >= 10) {
                Cache::put('blacklist_'.$ip, true, now()->addMinutes(10));
            }
        }

       
        if (Cache::get('blacklist_'.$ip)) {
            return response()->json([
                'message' => 'IP adresiniz 10 dakika boyunca engellenmiştir.'
            ], Response::HTTP_FORBIDDEN); // 403 Forbidden
        }

        return response()->json([
            'message' => 'Geçersiz veya eksik token.'
        ], Response::HTTP_UNAUTHORIZED); // 401 Unauthorized
    }
}
