<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename PreventBackHistory.php
 * @LastModified 24/03/2020, 23:56
 */

namespace App\Http\Middleware;

use Closure;

class PreventBackHistory
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
        $response = $next($request);

        $response->headers->set('Access-Control-Allow-Origin' , '*');
        $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Accept, Authorization, X-Requested-With, Application');

        return $response;
        // $response = $next($request);

        // return $response->header('Cache-Control','nocache, no-store, max-age=0, must-revalidate')
        //                 ->header('Pragma','no-cache')
        //                 ->header('Expires','Sun, 02 Jan 1990 00:00:00 GMT');
    }
}
