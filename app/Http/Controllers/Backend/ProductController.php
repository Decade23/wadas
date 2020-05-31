<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename ProductController.php
 * @LastModified 31/05/2020, 02:22
 */

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $service, $module;
    /**
     * PostsController constructor.
     */
    public function __construct(PostsServiceContract $postsServiceContract)
    {
        $this->service = $postsServiceContract;
        $this->module = 'backend.fulfillments.posts.';
    }

    public function index()
    {
        return view($this->module. 'index');
    }

    public function datatable(Request $request)
    {
        if ($request->ajax())
        {
            return $this->service->datatable($request);
        }
        abort('404', 'Uups');
    }
}
