<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Log; // Log modelini kullanacağız

class LogRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // İstek detaylarını alıyoruz
        $ipAddress = $request->ip();
        $method = $request->method();
        $url = $request->fullUrl();
        $userAgent = $request->header('User-Agent');

        // İstek bilgilerini logs tablosuna kaydediyoruz
        Log::create([
            'ip_address' => $ipAddress,
            'method'     => $method,
            'url'        => $url,
            'user_agent' => $userAgent,
        ]);

        return $next($request);
    }
}
