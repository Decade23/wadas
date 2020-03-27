<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename SetLocale.php
 * @LastModified 23/03/2020, 21:44
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

/**
 * Class SetLocale
 * @package App\Http\Middleware
 */
class SetLocale
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
        # 1. set default locale
        $default = config('app.locale');

        # 2. retrieve selected locale if exist (otherwise return the default)
        $locale = Session::get('locale', $default);

        # 3. set the locale
        App::setLocale($locale);

        return $next($request);
    }
}
