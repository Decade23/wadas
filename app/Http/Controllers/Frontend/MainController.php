<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename MainController.php
 * @LastModified 10/05/2020, 11:11
 */

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\Main\MainServiceContract;
use Illuminate\Http\Request;

class MainController extends Controller
{
    protected $titlePage, $service;
    /**
     * MainController constructor.
     */
    public function __construct(MainServiceContract $mainServiceContract)
    {
        $this->titlePage = 'Expert Club Indonesia';
        $this->service = $mainServiceContract;
    }

    public function index()
    {
        $data['seo_og_site_name'] = $this->titlePage;
        $data['titlePage'] = $this->titlePage;
        $data['tagLine'] = 'Strategic Agility Business Improvement Change Agent';
        $data['data']   = $this->service->news();
        $data['dataDb']['blog'] = $this->service->blog();
        #dd($data);

        return view('frontend.main.index', $data);
    }

    public function disclaimer()
    {
        $data['seo_og_site_name'] = $this->titlePage;
        $data['titlePage'] = $this->titlePage;
        $data['tagLine'] = 'Disclaimer';

        return view('frontend.pages.disclaimer', $data);
    }
}
