<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename PostsController.php
 * @LastModified 21/05/2020, 01:08
 */

namespace App\Http\Controllers\Backend\Fulfillments;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Fulfillments\Posts\postCreate;
use App\Services\Backend\Fulfillments\Posts\PostsServiceContract;
use App\Services\Backend\Media\MediaServicesContract;
use App\Traits\redirectTo;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    use redirectTo;

    private $service, $module, $productFolder;
    /**
     * PostsController constructor.
     */
    public function __construct(PostsServiceContract $postsServiceContract)
    {
        $this->service = $postsServiceContract;
        $this->module = 'backend.fulfillments.posts.';
        $this->productFolder = 'cms_posts';
    }

    public function index()
    {
        return view($this->module. 'index');
    }

    public function create()
    {
        return view($this->module. 'create');
    }

    public function store(postCreate $request)
    {
        #if success insert into DB
        if  (is_object($this->service->store($request))) {
            return $this->redirectSuccessCreate(route('posts.index'),'Success Created.');
        }

        #if fails insert into DB
        return $this->redirectFailed(route('posts.index'),'Error! Unsuccessfully. Fail to created.');
    }

    public function datatable(Request $request)
    {
        if ($request->ajax())
        {
            return $this->service->datatable($request);
        }
        abort('404', 'Uups');
    }

    public function imageUpload(Request $request, MediaServicesContract $mediaServicesContract)
    {

        return $mediaServicesContract->storeMedia($request, $this->productFolder,'');
    }

    public function retrieveImageUpload(Request $request, MediaServicesContract $mediaServicesContract)
    {
        # retrieve image
        return $mediaServicesContract->retrieveUploadFiles($request, $this->productFolder);
    }

    public function retrieveImageCreateUpload(Request $request, MediaServicesContract $mediaServicesContract)
    {
        # retrieve image
        return $mediaServicesContract->retrieveUploadCreateFiles($request, $this->productFolder);
    }

    public function deleteImageUpload(Request $request, MediaServicesContract $mediaServicesContract)
    {
        return $mediaServicesContract->deleteMediaFromProvider($request->name,$this->productFolder);
    }

    public function select2(Request $request)
    {
        if ($request->ajax())
        {
            return $this->service->select2($request);
        }
        abort('404', 'Uups');
    }
}
