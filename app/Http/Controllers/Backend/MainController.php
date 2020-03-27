<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class MainController
 * @package App\Http\Controllers\Backend
 */
class MainController extends Controller
{
    /**
     * MainController constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
//        dd(asset('public/themes/eci/plugins/global/plugins.bundle.js'));
        return view('backend.main_page.index');
    }
}
