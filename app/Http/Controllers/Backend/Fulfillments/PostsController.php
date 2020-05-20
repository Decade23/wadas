<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename PostsController.php
 * @LastModified 21/05/2020, 01:08
 */

namespace App\Http\Controllers\Backend\Fulfillments;

use App\Http\Controllers\Controller;
use App\Services\Backend\Fulfillments\Posts\PostsServiceContract;
use Illuminate\Http\Request;

class PostsController extends Controller
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
