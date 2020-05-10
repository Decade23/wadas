<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename MainController.php
 * @LastModified 10/05/2020, 11:11
 */

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    protected $titlePage;
    /**
     * MainController constructor.
     */
    public function __construct()
    {
        $this->titlePage = 'Expert Club Indonesia';
    }

    public function index()
    {
        $data['titlePage'] = $this->titlePage;
        $data['tagLine'] = 'Strategic Agility Business Improvement Change Agent';

        return view('frontend.main.index', $data);
    }
}
