<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class CacheHttp
{
    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $key= $request->fullUrl();
        if(\Cache::has($key)){
            return response()->json(json_decode(\Cache::get($key)));
        }

        return $next($request);
    }

    /**
     * @param $request
     */
    public function terminate($request, $response){

        $key= $request->fullUrl();


        if (!\Cache::has($key)){

            \Cache::put($key,$response->getContent(),60);
        }
    }
}
