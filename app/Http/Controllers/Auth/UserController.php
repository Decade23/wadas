<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename UserController.php
 * @LastModified 26/03/2020, 01:00
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\User\UserServiceContract;
use Illuminate\Http\Request;

/**
 * Class UserController
 * @package App\Http\Controllers\Auth
 */
class UserController extends Controller
{
    private $service;

    /**
     * UserController constructor.
     */
    public function __construct(
        UserServiceContract $userServiceContract
    )
    {
        $this->service = $userServiceContract;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('backend.user_page.index');
    }

    public function datatable(Request $request)
    {
        return $this->service->datatable($request);
    }
}
