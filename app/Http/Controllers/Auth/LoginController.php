<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename LoginController.php
 * @LastModified 24/03/2020, 03:10
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\loginRequest;
use App\Services\Auth\AuthService;
use App\Services\Auth\AuthServiceContract;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;

/**
 * Class LoginController
 * @package App\Http\Controllers\Auth
 */
class LoginController extends Controller
{
    /**
     * @var AuthServiceContract
     */
    private $service;

    /**
     * LoginController constructor.
     * @param $service
     */
    public function __construct(
        AuthServiceContract $authServiceContract
    )
    {
        $this->service = $authServiceContract;
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function showLoginForm(){
        # if already login to console
        if (Sentinel::check()) {
            if ( Sentinel::getUser()->user_role->role->slug == 'root' || Sentinel::getUser()->user_role->role->slug == 'admin' ) {
                return redirect()->route('main.index');
            } else {
                return view('auth.login');
            }
        } else {
            # if not yet login to console
            return view('auth.login');
        }
    }

    /**
     * @param loginRequest $request
     * @return mixed
     */
    public function login(loginRequest $request){
        return $this->service->login($request);
    }

    /**
     * @return mixed
     */
    public function logout() {
        return $this->service->logout();
    }
}
