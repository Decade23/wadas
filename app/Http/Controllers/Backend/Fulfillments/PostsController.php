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
use App\Http\Requests\Backend\Fulfillments\Posts\postUpdate;
use App\Services\Backend\Fulfillments\Posts\PostsServiceContract;
use App\Services\Backend\Media\MediaServicesContract;
use App\Traits\redirectTo;
use Illuminate\Http\Request;

/**
 * Class PostsController
 * @package App\Http\Controllers\Backend\Fulfillments
 */
class PostsController extends Controller
{
    use redirectTo;

    /**
     * @var PostsServiceContract|string
     */
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

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view($this->module. 'index');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view($this->module. 'create');
    }

    /**
     * @param postCreate $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(postCreate $request)
    {
        #if success insert into DB
        if  (is_object($this->service->store($request))) {
            return $this->redirectSuccessCreate(route('posts.index'),'Success Created.');
        }

        #if fails insert into DB
        return $this->redirectFailed(route('posts.index'),'Error! Unsuccessfully. Fail to created.');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data['dataDb'] = $this->service->getById($id);
        #dd( isset( $data['dataDb']->product ) );
        return view($this->module. 'edit', $data);
    }

    /**
     * @param postUpdate $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(postUpdate $request, $id)
    {
        #if success update into DB

        if  (is_object($tes = $this->service->update($id,$request))) {

            return $this->redirectSuccessUpdate(route('posts.index'),'Success Updated.');
        }

        #if fails update into DB
        return $this->redirectFailed(route('posts.index'),'Error! Unsuccessfully. Fail to updated.');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        #if success delete product
        if ($this->service->destroy($id)) {
            return $this->redirectSuccessDelete(route('posts.index'), 'Success Deleted.');
        }

        #if fails delete product
        return $this->redirectFailed(route('posts.index'),'Error! Unsuccessfully. Fail to deleted.');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function datatable(Request $request)
    {
        if ($request->ajax())
        {
            return $this->service->datatable($request);
        }
        abort('404', 'Uups');
    }

    /**
     * @param Request $request
     * @param MediaServicesContract $mediaServicesContract
     * @return mixed
     */
    public function imageUpload(Request $request, MediaServicesContract $mediaServicesContract)
    {

        return $mediaServicesContract->storeMedia($request, $this->productFolder,'');
    }

    /**
     * @param Request $request
     * @param MediaServicesContract $mediaServicesContract
     * @return mixed
     */
    public function retrieveImageUpload(Request $request, MediaServicesContract $mediaServicesContract)
    {
        # retrieve image
        return $mediaServicesContract->retrieveUploadFiles($request, $this->productFolder);
    }

    /**
     * @param Request $request
     * @param MediaServicesContract $mediaServicesContract
     * @return mixed
     */
    public function retrieveImageCreateUpload(Request $request, MediaServicesContract $mediaServicesContract)
    {
        # retrieve image
        return $mediaServicesContract->retrieveUploadCreateFiles($request, $this->productFolder);
    }

    /**
     * @param Request $request
     * @param MediaServicesContract $mediaServicesContract
     * @return mixed
     */
    public function deleteImageUpload(Request $request, MediaServicesContract $mediaServicesContract)
    {
        return $mediaServicesContract->deleteMediaFromProvider($request->name,$this->productFolder);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function select2(Request $request)
    {
        if ($request->ajax())
        {
            return $this->service->select2($request);
        }
        abort('404', 'Uups');
    }
}
