<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename SalesService.php
 * @LastModified 17/06/2020, 00:48
 */

namespace App\Services\Backend\Sales;


use App\Models\Auth\Role;
use App\Models\Auth\User;
use App\Models\Media;
use App\Models\OrderDetails;
use App\Models\Orders;
use App\Models\Product;
use App\Models\Sales;
use App\Services\Backend\Media\MediaServicesContract;
use App\Traits\fileUploadTrait;
use App\Traits\Users\MemberTrait;
use App\Traits\Users\UserProductTrait;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Dompdf\Dompdf;

class SalesService implements SalesServiceContract
{
    use MemberTrait, UserProductTrait, fileUploadTrait;
    private $model, $productFolder, $media;
    /**
     * SalesService constructor.
     */
    public function __construct(Orders $orders, MediaServicesContract $mediaServicesContract)
    {
        $this->model = $orders;
        $this->productFolder = 'payment';
        $this->media = $mediaServicesContract;
    }

    public function get(int $id)
    {
        return Orders::with(['details', 'customer' => function ($query) {
            $query->with('address');
        }, 'agent', 'bank','shipping','media'])->where('id', $id)->first();
    }

    /**
     * @param Request $request
     *
     * @return string
     * @throws \Exception
     */
    public function store($request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {

            #Save Member Data To User Table
            $userDb = $this->storeMemberBySales($request);

            #Save Member Address To User Address Table
            $this->storeMemberAddress($userDb->id, $request->member);

            $date  = date('ymd');
            $order = Orders::orderBy('id','desc')->first();
            if($order == null){
                $id = 1;
            }
            else{

                $code_last = substr($order->order_code,-4);
                $code_date = substr($order->order_code, 0 ,6);
                if($code_date == $date){
                    $id = (int)$code_last +1;

                }
                else{
                    $id = 1;
                }
            }
            $order_code_new = $date.sprintf("%04d", $id);

            #Save Orders
            $orderDb                 = new Orders();
            $orderDb->order_date     = $request->orderDate;
            $orderDb->order_code     = $order_code_new;
            $orderDb->customer_id    = $userDb->id;
            $orderDb->type           = $request->type;
            $orderDb->total_price    = collect($request->products)->pluck('product_price')->sum();
            $orderDb->payment_status = $request->paymentStatus;
            $orderDb->bank_id        = $request->bank_id;

            if ($request->paymentStatus !== 'paid') {
                #Add Due Date For 3 Hours

                $orderDb->due_date = now()->addHour(3);

            } else {
                $orderDb->paid_at = now();
            }

            $orderDb->agent_id = Sentinel::getUser()->id;
            $orderDb->save();

            #Add Orders Details
            //$membership = 0;
            foreach ($request->products as $product){

                $product['order_id'] = $orderDb->id;
                $orderDetailDb = $this->storeOrderDetails($product);

                if($request->paymentStatus == 'paid'){
                    $this->storeUserProduct($orderDetailDb, 0);
                }

                #attach to Group
                //$this->attachToGroup($userDb, $product['product_name']);
            }

            if($request->paymentStatus == 'paid'){
                #send email payment success
                // $this->send_email_paid_1($orderDb);
                // $this->send_email_paid_2($orderDb);
                // $this->send_email_paid_3($userDb);

                //$this->send_email_welcome($userDb);
            }

            #insert media (image)
            if (is_array($request->document)) {
                foreach ($request->document as $file_name) {
                    $path   = 'public/'. $this->uploadPath .'/'. $this->productFolder . '/'. $file_name;
                    $url    = Storage::disk('s3')->url($path);
                    $files[] = [
                        'type'  => 'image',
                        'model' => 'Order',
                        'url'   => $url,
                        'path'  => $path,
                        'file_name' => $file_name
                    ];
                }
                $this->saveProductImages($files, $orderDb->id);
            }


            DB::commit();

            return $orderDb;

        } catch (\Exception $exception) {
            DB::rollBack();

            dd($exception->getMessage() . ' ' . $exception->getLine()  . ' ' . $exception->getCode());
            return $exception->getCode();
        }
    }

    /**
     * @param $product
     *
     * @return OrderDetails
     */
    public function storeOrderDetails($product)
    {

        $orderDetailDb = new OrderDetails();
        $orderDetailDb->fill($product);
        $orderDetailDb->save();

        return $orderDetailDb;
    }

    /**
     * @param int      $id
     * @param  Request $request
     *
     * @return mixed
     * @throws \Exception
     */
    public function update(int $id, $request)
    {

        DB::beginTransaction();
        try {

            $order = Orders::find($id);

            $oldPaymentStatus = $order->payment_status;

            $order->type           = $request->type;
            $order->bank_id        = $request->bank_id;
            $order->payment_status = $request->paymentStatus;

            #Change the payment status to paid when old data is unpaid
            $membership = 0;
            if($oldPaymentStatus == 'unpaid' && $request->payment_status == 'paid'){
                $order->paid_at   = now();
                $order->due_date  = null;
            }
            else if($request->payment_status == 'cancel'){
                $order->paid_at   = null;
                $order->due_date  = null;
            }

            $order->save();

            if($request->payment_status == 'paid'){
                // $this->send_email_paid_1($order);
                // $this->send_email_paid_2($order);
                // $this->send_email_paid_3($order->customer);
                //$this->send_email_welcome($order->customer);
            }

            #insert media (image)
            if (is_array($request->document)) {
                foreach ($request->document as $file_name) {
                    $path   = 'public/'. $this->uploadPath .'/'. $this->productFolder . '/'. $file_name;
                    $url    = Storage::disk('s3')->url($path);
                    $files[] = [
                        'type'  => 'image',
                        'model' => 'Order',
                        'url'   => $url,
                        'path'  => $path,
                        'file_name' => $file_name
                    ];
                }
                $this->updateProductImages($files, $order->id);
            }

            DB::commit();

            return $order;

        } catch (\Exception $exception) {

            DB::rollBack();
            dd($exception);
            dd($exception->getMessage() . ' ' . $exception->getLine());
            // return $exception->getCode();
        }
    }

    /**
     * @param $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function datatable($request)
    {
        $select = [
            'orders.id',
            'orders.type',
            'order_date',
            'order_code',
            'customer_id',
            'agent_id',
            'total_price',
            'payment_status',
            'paid_at',
            'due_date',
            'step',
            'orders.created_at',
            'orders.updated_at',
            //'users.name'
        ];

        $dataDb = Orders::select($select)->orderDate($request->order_date)->paidAt($request->paid_at)->dueDate($request->due_date)->type($request->type)->seller($request->seller)->Price()->distinct('orders.order_code')->with(['customer', 'agent','details','shipping']);

        if ($request->productType) {

            $dataDb->whereHas('details', function(Builder $query) use ($request){
                $query->where('product_type', $request->productType); //
            });
        }

        return DataTables::eloquent($dataDb)
            ->addColumn(
                'action',
                function ($dataDb) {
                    if($dataDb->payment_status == 'unpaid'){
                        //return '<a href="'.route('sales.show', $dataDb->id).'" id="tooltip" title="'.trans('global.show').'"><span class="label label-primary label-sm"><i class="fa fa-arrows-alt"></i></span></a> <a href="'.route('sales.edit', [$dataDb->id]).'" id="tooltip" title="'.trans('global.update').'"><span class="label label-warning label-sm"><i class="fa fa-edit"></i></span></a>';
                        return '<a href="'.route('sales.show', $dataDb->id).'" id="tooltip" data-tooltip-custom="tooltip" title="'.trans('global.show').'">
                            <span class="label label-primary label-sm">
                                <i class="fa fa-arrows-alt"></i>
                                </span>
                            </a>';
                    }
                    else if($dataDb->payment_status == 'cancel'){
                        return $dataDb->payment_status;
                        //return '<a href="'.route('sales.show', $dataDb->id).'" id="tooltip" title="'.trans('global.show').'"><span class="label label-primary label-sm"><i class="fa fa-arrows-alt"></i></span></a>';
                    }
                    else{
                        //return '<a href="'.route('sales.pdf', $dataDb->id).'" id="tooltip" title="PDF" target="_blank"><span class="label label-success label-sm"><i class="fa fa-file-pdf-o"></i></span></a> <a href="'.route('sales.show', $dataDb->id).'" id="tooltip" title="'.trans('global.show').'"><span class="label label-primary label-sm"><i class="fa fa-arrows-alt"></i></span></a>';
                        return '<a href="'.route('front_sales.index', $dataDb->id).'" id="tooltip" data-tooltip-custom="tooltip" title="'.trans('global.show').'" target="_blank">
                            <span class="label label-primary label-sm">
                                <i class="fa fa-arrows-alt"></i>
                                </span>
                            </a>';
                    }
                }
            )
            ->addColumn(
                'checkbox',
                function ($dataDb) {
                    return $dataDb->id;
                }
            )
            ->editColumn('payment_status', function($dataDb){
                return $dataDb->payment_status_view;
            })
            ->rawColumns(['payment_status', 'action'])
            ->make(true);
    }

    /**
     * Roll A Sales
     *
     * @param      $productSales
     *
     * @param null $userId
     *
     * @return mixed
     */
    public function rollSales($productSales, $userId = null){

        $lastOrderId = Orders::select('id')->orderBy('id', 'desc')->first();

        if($userId == null){
            if($productSales->isEmpty()){

                #Get users
                $user = User::join('role_users','users.id','=','role_users.user_id')->select('users.id')->where('type','user')->where('role_id',2)->get()->toArray();

                if($lastOrderId == false){
                    $lastOrderId = 0;
                }
                else{
                    $lastOrderId = $lastOrderId->id;
                }

                $rotation = ($lastOrderId + 1) % count($user);

                $salesId = $user[$rotation]["id"];

            } else {

                #Agent Users
                $user = $productSales->toArray();

                if($lastOrderId == false){
                    $lastOrderId = 0;
                }
                else{
                    $lastOrderId = $lastOrderId->id;
                }

                $rotation = ($lastOrderId + 1) % count($user);

                $salesId = $user[$rotation]["user_id"];

            }
        } else {
            $salesId = $userId;
        }


        return $salesId;

    }

    /**
     * Get Order For Select2
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function select2($request)
    {
        try {
            $perPage = 10;
            $page    = $request->page ?? 1;

            Paginator::currentPageResolver(
                function () use ($page) {
                    return $page;
                }
            );

            $dataDb = Orders::select('id', 'order_code as text', 'customer_id', 'agent_id')
                ->with(['details','customer','agent'])
                ->where('order_code', 'LIKE', '%'.$request->term.'%')
                ->orderBy('id')->paginate($perPage);

            return $dataDb;

        } catch (\Exception $exception) {

            // dd($exception->getMessage());
            return $exception->getCode();
        }
    }

    public function seller_select2($request)
    {
        try {
            $perPage = 10;
            $page    = $request->page ?? 1;

            Paginator::currentPageResolver(
                function () use ($page) {
                    return $page;
                }
            );

            $role = Role::where('slug','sales')->first();
            $dataDb = User::join('role_users','users.id','=','role_users.user_id')
                ->select('users.id','name as text')
                ->where('role_id',$role->id)
                ->where('name', 'LIKE', '%'.$request->term.'%')
                ->orderBy('id')->paginate($perPage);

            return $dataDb;

        } catch (\Exception $exception) {

            // dd($exception->getMessage());
            return $exception->getCode();
        }
    }

    public function destroyBulk(array $id)
    {
        return Orders::whereIn('id', $id)->delete();
    }

    public function destroy(int $id)
    {
        return Orders::find($id)->delete();
    }

    public function penyebut($nilai) {
        $nilai = abs($nilai);
        $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " ". $huruf[$nilai];
        }
        else if ($nilai <20) {
            $temp = $this->penyebut($nilai - 10). " Belas";
        }
        else if ($nilai < 100) {
            $temp = $this->penyebut($nilai / 10)." Puluh". $this->penyebut($nilai % 10);
        }
        else if ($nilai < 200) {
            $temp = " Seratus" . $this->penyebut($nilai - 100);
        }
        else if ($nilai < 1000) {
            $temp = $this->penyebut($nilai / 100) . " Ratus" . $this->penyebut($nilai % 100);
        }
        else if ($nilai < 2000) {
            $temp = " Seribu" . $this->penyebut($nilai - 1000);
        }
        else if ($nilai < 1000000) {
            $temp = $this->penyebut($nilai / 1000) . " Ribu" . $this->penyebut($nilai % 1000);
        }
        else if ($nilai < 1000000000) {
            $temp = $this->penyebut($nilai / 1000000) . " Juta" . $this->penyebut($nilai % 1000000);
        }
        else if ($nilai < 1000000000000) {
            $temp = $this->penyebut($nilai / 1000000000) . " Miliar" . $this->penyebut(fmod($nilai,1000000000));
        }
        else if ($nilai < 1000000000000000) {
            $temp = $this->penyebut($nilai / 1000000000000) . " Triliun" . $this->penyebut(fmod($nilai,1000000000000));
        }
        return $temp;
    }

    public function terbilang($nilai) {
        if($nilai < 0) {
            $hasil = "Minus ". trim($this->penyebut($nilai));
        }
        else {
            $hasil = trim($this->penyebut($nilai));
        }
        return $hasil;
    }

    public function pdf($id){
//        $pdf = new Dompdf();
//        $pdf->loadHtml('<h1>. $id .</h1>');
//        $pdf->setPaper('A4', 'landscape');
//        $pdf->render();
//        return $pdf->stream();

//        $temp = App::make('dompdf.wrapper');
//        $temp->load
        $data['dataDb'] = $this->get($id);
        //dd($data['dataDb']->created_at_order);

        return view('backend.sales.pdf', $data);
        $pdf = new Dompdf();
        $view = \View::make('backend.sales.pdf_view', $data);
        $pdf->loadHtml($view);
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();
        return $pdf->stream($data['dataDb']->order_code);



        $sale = Orders::with(['details', 'customer' => function ($query) {
            $query->with('address');
        }, 'agent', 'bank','shipping'])->where('id', $id)->first();

        $date = $sale->order_date;
        $day = date('d',strtotime($date));
        $month = date('m',strtotime($date));
        $year = date('Y',strtotime($date));

        if($month == '01'){
            $month = 'Januari';
        }
        else if($month == '02'){
            $month = 'Februari';
        }
        else if($month == '03'){
            $month = 'Maret';
        }
        else if($month == '04'){
            $month = 'April';
        }
        else if($month == '05'){
            $month = 'Mei';
        }
        else if($month == '06'){
            $month = 'Juni';
        }
        else if($month == '07'){
            $month = 'Juli';
        }
        else if($month == '08'){
            $month = 'Agustus';
        }
        else if($month == '09'){
            $month = 'September';
        }
        else if($month == '10'){
            $month = 'Oktober';
        }
        else if($month == '11'){
            $month = 'November';
        }
        else if($month == '12'){
            $month = 'Desember';
        }

        $terbilang = $this->terbilang($sale->total_price);

        $pdf = PDF::loadView('backend.sales.pdf',compact('sale','terbilang','year','month','day'));
        return $pdf->stream('Invoice '.$sale->order_code.'.pdf');
    }

    private function saveProductImages($request, $productId)
    {
        #delete existing file
        $this->destroyImages($productId);

        $imagesDb = [];
        #insert new media into db
        foreach ($request as $image) {
            $imagesDb[] = Media::create([
                'type'      => $image['type'],
                'item_id'   => $productId,
                'url'       => $image['url'],
                'model'     => $image['model'],
                'path'      => $image['path'],
                'file_name'  => $image['file_name'],
                'created_by'  => Sentinel::getUser()->email,
                'updated_by'  => Sentinel::getUser()->email
            ]);
        }

        return $imagesDb;
    }

    private function destroyImages($productId)
    {
        //Media::where('item_id', $productId)->delete();
        return $this->media->deleteMediaByItemId($productId);

    }

    private function updateProductImages($request, $productId)
    {

        #check if file is same
        $imagesDb = [];
        #insert new media into db

        foreach ($request as $image) {
            #if file not same with the old one
            $fileDb = $this->media->getMediaByFileName($image['file_name']);
            if ( !isset($fileDb->file_name) ) {
                $imagesDb[] = Media::create([
                    'type'      => $image['type'],
                    'item_id'   => $productId,
                    'url'       => $image['url'],
                    'model'     => $image['model'],
                    'path'      => $image['path'],
                    'file_name'  => $image['file_name'],
                    'created_by'  => Sentinel::getUser()->email,
                    'updated_by'  => Sentinel::getUser()->email
                ]);
            } else if ($fileDb->file_name != $image['file_name']) {
                # if file exist in db then delete it
                $this->media->deleteMediaByFileName($fileDb->file_name);
            }
        }

        return $imagesDb;
    }

    public function invoice($id)
    {
        $data['dataDb'] = $this->get($id);
        //dd($data['dataDb']->created_at_order);

        return view('backend.sales.invoice', $data);
//        $pdf = new Dompdf();
//        $view = \View::make('backend.sales.pdf_view', $data);
//        $pdf->loadHtml($view);
//        $pdf->setPaper('A4', 'landscape');
//        $pdf->render();
//        return $pdf->stream($data['dataDb']->order_code);
    }
}
