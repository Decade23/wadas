<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename SentinelPermission.php
 * @LastModified 23/03/2020, 21:00
 */

namespace App\Http\Middleware;

use Cartalyst\Sentinel\Hashing\BcryptHasher;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Closure;

/**
 * Class SentinelPermission
 * @package App\Http\Middleware
 */
class SentinelPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        Sentinel::setHasher( new BcryptHasher() );

        $user = Sentinel::check();

        if (! $user) {
            return redirect()->guest('console/login');
        }

        if ( isset($user->roles[0]) && $user->roles[0]->slug == 'root' ) {
            return $next( $request );
        }

        if ( $user->hasAccess( $role ) ) {
            return $next( $request );
        }

        if ( $request->ajax() || $request->wantsJson() ) {
            return response('unauthorized',401);
        }

        # return abort 404
        return redirect('no-access');
    }
}
