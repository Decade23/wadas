<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename ProductServices.php
 * @LastModified 31/05/2020, 02:28
 */

namespace App\Services\Backend\Product;


use App\Models\Products\Product;
use Yajra\DataTables\Facades\DataTables;

class ProductServices implements ProductServicesContract
{
    private $model;

    /**
     * ProductServices constructor.
     */
    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function get()
    {
        // TODO: Implement get() method.
    }

    public function store($request)
    {
        // TODO: Implement store() method.
    }

    public function update(int $id, $request)
    {
        // TODO: Implement update() method.
    }

    public function destroy(int $id)
    {
        // TODO: Implement destroy() method.
    }

    public function destroyBulk(array $id)
    {
        // TODO: Implement destroyBulk() method.
    }

    public function datatable($request)
    {
        // TODO: Implement datatable() method.
        $query = $this->queryProducts($request);

        return DataTables::eloquent($query)
            ->editColumn('created_at', function($dataDb) {
                return $dataDb->created_at->format('Y-m-d H:i:s');
            })
            ->editColumn('updated_at', function($dataDb) {
                return $dataDb->updated_at->format('Y-m-d H:i:s');
            })
//            ->addColumn(
//                'checkbox',
//                function ($dataDb) {
//                    return '<label class="kt-checkbox kt-checkbox--single kt-checkbox--solid kt-checkbox--brand"><input type="checkbox" value="'.$dataDb->id.'" class="kt-checkable"><span></span></label>'; //$dataDb->id;
//                }
//            )
            ->addColumn('group_name', function ($dataDb){
                return '';
            })
            ->addColumn('action', function ($dataDb){
                $btnShow = '';
                $btnEdit = '';
                $btnDelete = '';

                if (Sentinel::inRole('root') || Sentinel::hasAccess(['product.show'])) {
                    $btnShow = '<a href="'.route('product.show', $dataDb->id).'" id="tooltip" data-tooltip-custom="tooltip" title="'.trans('global.show').'">
                            <span class="label label-primary label-sm">
                                <i class="fa fa-arrows-alt"></i>
                                </span>
                            </a>';
                }

                if (Sentinel::inRole('root') || Sentinel::hasAccess(['product.edit'])) {
                    $btnEdit = '<a href="'.route('product.edit', $dataDb->id).'"
                            data-tooltip-custom="tooltip" title="'.trans('global.update').'" >
                            <i class="flaticon-edit kt-font-brand"></i>
                            </a>
                            ';
                }

                if (Sentinel::inRole('root') || Sentinel::hasAccess(['product.destroy'])) {
                    $btnDelete = '<a href="#"
                                data-message="'.trans('auth.delete_confirmation', ['name' => $dataDb->name]).'"
                                data-href="'.route('product.destroy', $dataDb->id).'"
                                data-method="DELETE"
                                title="'.trans('global.delete').'"
                                data-original-title="'.trans('global.delete').'"
                                data-title="'.trans('global.delete').'"
                                data-title-modal="Are u sure for delete this?"
                                data-toggle="modal"
                                data-target="#delete">
                                <i class="flaticon-delete kt-font-danger"></i>
                    </a>';
                }
                return $btnEdit . $btnDelete;
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function select2($request)
    {
        // TODO: Implement select2() method.
    }

    public function queryProducts($request)
    {
        // TODO: Implement queryProducts() method.
        $select = [
            'products.id', 'products.type', 'products.name', 'products.slug',  'products.short_desc', 'products.description', 'time_period', 'start_at', 'end_at', 'price', 'visibility',
            'products.created_at', 'products.updated_at', 'products.created_by', 'products.updated_by'
        ];

        $dataDb = $this->model::select($select);

        return $dataDb;
    }

}
