<?php

namespace App\Http\Controllers\Backend\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Products\productGroupCreateRequest;
use App\Http\Requests\Backend\Products\productGroupUpdateRequest;
use App\Services\Backend\Products\ProductGroup\ProductGroupServicesContract;
use App\Traits\redirectTo;
use Illuminate\Http\Request;

class ProductGroupController extends Controller
{
    use redirectTo;
    private $service, $module;
    /**
     * PostsController constructor.
     */
    public function __construct(ProductGroupServicesContract $productGroupServicesContract)
    {
        $this->service = $productGroupServicesContract;
        $this->module = 'backend.products.product_group.';
    }

    public function index()
    {
        return view($this->module. 'index');
    }

    public function create()
    {
        return view($this->module. 'create');
    }

    public function store(productGroupCreateRequest $request)
    {
        #if success insert into DB
        if  (is_object($this->service->store($request))) {
            return $this->redirectSuccessCreate(route('product_group.index'),'Success Created.');
        }

        #if fails insert into DB
        return $this->redirectFailed(route('product_group.index'),'Error! Unsuccessfully. Fail to created.');
    }

    public function edit($id)
    {
        $data['dataDb'] = $this->service->getGroupById($id);

        return view( $this->module. 'edit', $data);
    }

    public function update(productGroupUpdateRequest $request, $id)
    {
        #if success update into DB
        if  (is_object($this->service->update($id,$request))) {
            return $this->redirectSuccessUpdate(route('product_group.index'),'Success Updated.');
        }

        #if fails update into DB
        return $this->redirectFailed(route('product_group.index'),'Error! Unsuccessfully. Fail to updated.');
    }

    public function destroy($id)
    {
        #if success delete product group
        if ($this->service->destroy($id)) {
            return $this->redirectSuccessDelete(route('product_group.index'), 'Success Deleted.');
        }

        #if fails delete product group
        return $this->redirectFailed(route('product_group.index'),'Error! Unsuccessfully. Fail to deleted.');
    }

    public function datatable(Request $request)
    {
        if ($request->ajax())
        {
            return $this->service->datatable($request);
        }
        abort('404', 'Uups');
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
