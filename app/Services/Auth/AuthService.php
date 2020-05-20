<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename AuthService.php
 * @LastModified 24/03/2020, 23:25
 */

namespace App\Services\Auth;


use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Session;

class AuthService implements AuthServiceContract
{
    public function __construct()
    {
    }

    public function login($request)
    {
        // TODO: Implement login() method.
        $credentials = [
            'email'     => $request->email,
            'password'  => $request->password,
        ];

        $remember = $request->remember == 'on' ? true : false;

        try {
            if ( $userDb = Sentinel::authenticate($credentials, $remember) ) {

                if ( Sentinel::getUser()->user_role->role->slug == 'root' || Sentinel::getUser()->user_role->role->slug != 'member' ) {
                    Session::flash('success', 'Login Successfull');
                    if ( $request->rto != null ) { # if success login and get rto (rto is last page visitor login)
                        return redirect()->to($request->rto);
                    } else { # if success login

                        return redirect()->route('main.index');
                    }
                } else {
                    Sentinel::logout();
                    Session::flash('failed', 'Login Unsuccessful');

                    return redirect()->route('login.form');
                }
            } else {
                Session::flash('failed', 'Login Unsuccessful');

                return redirect()->route('login.form');
            }
        } catch (ThrottlingException $throttlingException) {

            Session::flash('failed', 'Login Timeout');
            return redirect()->route('login.form');
        } catch (NotActivatedException $notActivatedException) {

            Session::flash('failed', 'Login Fail. Account Not Active');
            return redirect()->route('login.form');
        }
    }

    public function logout()
    {
        // TODO: Implement logout() method.
        Sentinel::logout();
        Session::flash('success', __('auth'));

        return redirect()->route('main.index');
    }

}
