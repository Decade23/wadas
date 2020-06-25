<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename ProductController.php
 * @LastModified 01/06/2020, 03:29
 */

namespace App\Http\Controllers\Backend\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Products\productCreateRequest;
use App\Http\Requests\Backend\Products\productUpdateRequest;
use App\Services\Backend\Media\MediaServicesContract;
use App\Services\Backend\Products\Product\ProductServicesContract;
use App\Traits\redirectTo;
use Illuminate\Http\Request;

/**
 * Class ProductController
 * @package App\Http\Controllers\Backend\Products
 */
class ProductController extends Controller
{
    use redirectTo;

    /**
     * @var ProductServicesContract
     */
    /**
     * @var ProductServicesContract|string
     */
    private $service, $module, $productFolder;
    /**
     * PostsController constructor.
     */
    public function __construct(ProductServicesContract $productServicesContract)
    {
        $this->service = $productServicesContract;
        $this->module = 'backend.products.';
        $this->productFolder = 'media';
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view($this->module. 'index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view($this->module. 'create');
    }

    /**
     * @param productCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(productCreateRequest $request)
    {
        #if success insert into DB
        if  (is_object($this->service->store($request))) {
            return $this->redirectSuccessCreate(route('product.index'),'Success Created.');
        }

        #if fails insert into DB
        return $this->redirectFailed(route('product.index'),'Error! Unsuccessfully. Fail to created.');
    }

    public function edit($id)
    {
        $data['dataDb'] = $this->service->getById($id);

        return view($this->module. 'edit', $data);
    }

    public function update(productUpdateRequest $request, $id)
    {
        #if success update into DB

        if  (is_object($tes = $this->service->update($id,$request))) {

            return $this->redirectSuccessUpdate(route('product.index'),'Success Updated.');
        }

        #if fails update into DB
        return $this->redirectFailed(route('product.index'),'Error! Unsuccessfully. Fail to updated.');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        #if success delete product
        if ($this->service->destroy($id)) {
            return $this->redirectSuccessDelete(route('product.index'), 'Success Deleted.');
        }

        #if fails delete product
        return $this->redirectFailed(route('product.index'),'Error! Unsuccessfully. Fail to deleted.');
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

    public function select2(Request $request)
    {
        if ($request->ajax())
        {
            return $this->service->select2($request);
        }
        abort('404', 'Uups');
    }
}
