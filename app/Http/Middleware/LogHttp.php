<?php

namespace App\Http\Middleware;

use Closure;
use \Log;

class LogHttp
{

    public $start = null;
    public $end = null;

    public function handle($request, Closure $next)
    {
        $this->start = microtime(true);

        return $next($request);
    }

    public function terminate($request, $response)
    {
        $this->end = microtime(true);

        $this->log($request, $response ,$this->start, $this->end);
    }

    protected static function log($request, $response, $start, $end)
    {
        $duration = $end - $start;
        $url = $request->fullUrl();
        $method = $request->getMethod();
        $ip = $request->getClientIp();

        $log = "{$ip}: {$method}@{$url} - {$duration}ms\n {$response}";

        Log::info($log);
    }
}
