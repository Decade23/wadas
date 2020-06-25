<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename SalesController.php
 * @LastModified 17/06/2020, 00:46
 */

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Sales\salesRequest;
use App\Services\Backend\Media\MediaServicesContract;
use App\Services\Backend\Sales\SalesServiceContract;
use App\Traits\redirectTo;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    use redirectTo;

    private $service, $module, $pageTitle, $productFolder;

    /**
     * SalesController constructor.
     */
    public function __construct(SalesServiceContract $salesServiceContract)
    {
        $this->service = $salesServiceContract;
        $this->module = 'backend.sales.';
        $this->pageTitle = 'Sales';
        $this->productFolder = 'payment';
    }

    public function index()
    {
        $data['pageTitle'] = $this->pageTitle;
        return view($this->module. 'index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['pageTitle'] = $this->pageTitle;
        return view($this->module. 'create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param salesRequest         $request
     *
     * @param SalesServiceContract $salesServiceContract
     *
     * @return \Illuminate\Http\Response
     */
    public function store(salesRequest $request, SalesServiceContract $salesServiceContract)
    {
        #Save Product Data
        if (is_object($salesServiceContract->store($request))) {

            #Bump....
            return $this->redirectSuccessCreate(route('sales.index'), 'Sales');

        } else {

            #Bump....
            return $this->redirectFailed(route('sales.index'), 'Failed To Save The Sales');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int                 $id
     * @param SalesServiceContract $salesServiceContract
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['pageTitle'] = $this->pageTitle;
        $data['dataDb'] = $this->service->get($id);
        return view($this->module. 'detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int                 $id
     * @param SalesServiceContract $salesServiceContract
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id, SalesServiceContract $salesServiceContract)
    {
        $sale = $salesServiceContract->get($id);
        if($sale->payment_status == 'unpaid'){
            // dd($sale->details);
            $sumBook = 0;
            $sumPrice = 0;
            foreach ($sale->details as $el) {
                if ($el->product_type == 'book') {
                    # code...
                    $sumBook = $sumBook + $el->qty;
                }
                $sumPrice = $sumPrice + $el->product_price;
            }
            return view($this->module. 'update', ['sale' => $sale, 'sumBook' => $sumBook, 'sumPrice' => $sumPrice]);
        }
        else{
            return redirect()->route('sales.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param salesRequest         $request
     * @param  int                 $id
     *
     * @param SalesServiceContract $salesServiceContract
     *
     * @return \Illuminate\Http\Response
     */
    public function update(salesRequest $request, $id, SalesServiceContract $salesServiceContract)
    {
        #Save Product Data
        if (is_object($salesServiceContract->update($id, $request))) {

            #Bump....
            return $this->redirectSuccessUpdate(route('sales.index'), 'Sales');

        } else {

            #Bump....
            return $this->redirectFailed(route('sales.index'), 'Failed To Update The Sales');
        }

    }

    /**
     * Datatable Class
     *
     * @param Request              $request
     * @param SalesServiceContract $salesServiceContract
     *
     * @return \Illuminate\Http\JsonResponse|\Yajra\DataTables\DataTableAbstract
     */
    public function datatable(Request $request, SalesServiceContract $salesServiceContract)
    {
        if ($request->ajax()) {
            # Return The JSON datatables Data
            return $salesServiceContract->datatable($request);
        }

        abort('404', 'uups');
    }

    /**
     * Get Sales Select2
     *
     * @param Request                    $request
     * @param MemberServiceContract $memberServiceContract
     *
     */
    public function select2(Request $request, SalesServiceContract $salesServiceContract){

        if ($request->ajax() === true) {

            return $salesServiceContract->select2($request);
        }

        return abort('404', 'uups');
    }

    public function seller_select2(Request $request, SalesServiceContract $salesServiceContract){

        if ($request->ajax() === true) {

            return $salesServiceContract->seller_select2($request);
        }

        return abort('404', 'uups');
    }

    public function bulkDestroy(Request $request, SalesServiceContract $salesServiceContract)
    {
        #Get services for bulk delete
        $salesServiceContract->destroyBulk($request->id);

        #Bump....
        return $this->redirectSuccessDelete(route('sales.index'), 'Orders');
    }

    public function destroy($id, SalesServiceContract $salesServiceContract){
        #Get services for bulk delete
        $salesServiceContract->destroy($id);

        #Bump....
        return $this->redirectSuccessDelete(route('sales.index'), 'Orders');
    }

    public function pdf($id, SalesServiceContract $salesServiceContract)
    {
        return $salesServiceContract->pdf($id);
    }

    public function imageUpload(Request $request, MediaServicesContract $mediaServicesContract)
    {

        return $mediaServicesContract->storeMedia($request, $this->productFolder,'');
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
}
