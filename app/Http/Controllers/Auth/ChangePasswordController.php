<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\User\changePasswordRequest;
use App\Services\Auth\User\UserServiceContract;
use App\Traits\redirectTo;
use Illuminate\Http\Request;

class ChangePasswordController extends Controller
{
    use redirectTo;
    private $service;
    /**
     * ChangePasswordController constructor.
     */
    public function __construct(
        UserServiceContract $userServiceContract
    )
    {
        $this->service = $userServiceContract;
    }

    public function edit()
    {
        return view('auth.passwords.change');
    }

    public function update(changePasswordRequest $request)
    {
        #if success update into DB
        if  ($this->service->changePassword($request)) {
            return $this->redirectSuccessUpdate(route('login.form'),'Success Updated.');
        }

        #if fails update into DB
        return $this->redirectFailed(route('password.edit'),'Error! Unsuccessfully. Your old password mismatch.');
    }
}
