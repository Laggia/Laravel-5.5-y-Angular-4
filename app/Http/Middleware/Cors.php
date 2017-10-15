<?php

namespace App\Http\Middleware;

use Closure;

class Cors
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
        $allowedOrigins = array(
            '(http(s)://)?(www\.)?cursoangular\.app',
            'http://127.0.0.1:4200'
        );



        if(isset($_SERVER['HTTP_ORIGIN']) && $_SERVER['HTTP_ORIGIN'] != '' ){
            foreach ($allowedOrigins as $allowedOrigin) {
                if(preg_match('#'.$allowedOrigin.'#', $_SERVER['HTTP_ORIGIN'])){
                    return $next($request)
                        ->header('Access-Control-Allow-Origin', $_SERVER['HTTP_ORIGIN'])
                        ->header('Access-Control-Allow-Methods', 'GET, PUT, POST, DELETE, OPTIONS')
                         ->header('Access-Control-Max-Age', 1000)
                         ->header('Access-Control-Allow-Headers','Content-Type, Authorization, X-Request-With');
             
                }
            }
        }
        else
            return $next($request);
    }
}
