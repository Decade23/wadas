<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename ProductGroupServices.php
 * @LastModified 01/06/2020, 11:31
 */

namespace App\Services\Backend\Products\ProductGroup;


use App\Models\Groups;
use App\Models\Products\ProductGroups;
use App\Services\Backend\Groups\GroupServicesContract;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use mysql_xdevapi\Exception;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class ProductGroupServices
 * @package App\Services\Backend\Products\ProductGroup
 */
class ProductGroupServices implements ProductGroupServicesContract
{
    /**
     * @var ProductGroups
     */
    private $model, $group;


    /**
     * ProductGroupServices constructor.
     * @param ProductGroups $productGroups
     */
    public function __construct(ProductGroups $productGroups, GroupServicesContract $groupServicesContract)
    {
        $this->model = $productGroups;
        $this->group = $groupServicesContract;
    }

    /**
     * @return mixed|void
     */
    public function get()
    {
        // TODO: Implement get() method.
    }

    /**
     * @param $request
     * @return mixed|void
     */
    public function store($request)
    {
        // TODO: Implement store() method.
        # retrieve
        $userDb = Sentinel::getUser()->email;

        DB::beginTransaction();
        try {
            # insert to product groups
            $insert = new Groups();
            $insert->name = $request->name;
            $insert->slug = Str::slug($request->name, '-');
            $insert->type = 'product';
            $insert->created_by = $userDb;
            $insert->updated_by = $userDb;

            $insert->save();

            # commit to insert to DB
            DB::commit();

            # return to controller
            return $insert;

        } catch (\Exception $exception) {
            #rollback to begin (not insert to DB)
            DB::rollBack();
            #Dump
            //dd('Message: '.$exception->getMessage() . ' Line: ' . $exception->getLine()  . ' Code: ' . $exception->getCode());

            #return getCode Error
            return $exception->getCode();
        }
    }

    /**
     * @param int $id
     * @param $request
     * @return mixed|void
     */
    public function update(int $id, $request)
    {
        // TODO: Implement update() method.
        # retrieve
        $userDb = Sentinel::getUser()->email;

        DB::beginTransaction();
        try {
            #retrieve dataDb update
            $update = Groups::find($id);

            # insert to product groups
            $dataUpdate = [
                'name'          => $request->name,
                'slug'          => Str::slug($request->name, '-'),
                'type'          => 'product',
                'updated_by'    => $userDb
            ];

            $update->update($dataUpdate);

            # commit to insert to DB
            DB::commit();

            # return to controller
            return $update;

        } catch (\Exception $exception) {
            #rollback to begin (not insert to DB)
            DB::rollBack();
            #Dump
            //dd('Message: '.$exception->getMessage() . ' Line: ' . $exception->getLine()  . ' Code: ' . $exception->getCode());

            #return getCode Error
            return $exception->getCode();
        }
    }

    /**
     * @param int $id
     * @return mixed|void
     */
    public function destroy(int $id)
    {
        // TODO: Implement destroy() method.
        return $this->group->destroyGroupById($id);
    }

    /**
     * @param array $id
     * @return mixed|void
     */
    public function destroyBulk(array $id)
    {
        // TODO: Implement destroyBulk() method.
    }

    /**
     * @param $request
     * @return mixed|void
     */
    public function datatable($request)
    {
        // TODO: Implement datatable() method.
        $query = $this->group->getGroupByType('product');
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
            ->addColumn('action', function ($dataDb){
                $btnShow = '';
                $btnEdit = '';
                $btnDelete = '';

                if (Sentinel::inRole('root') || Sentinel::hasAccess(['product_group.show'])) {
                    $btnShow = '<a href="'.route('product_group.show', $dataDb->id).'" id="tooltip" data-tooltip-custom="tooltip" title="'.trans('global.show').'">
                            <span class="label label-primary label-sm">
                                <i class="fa fa-arrows-alt"></i>
                                </span>
                            </a>';
                }

                if (Sentinel::inRole('root') || Sentinel::hasAccess(['product_group.edit'])) {
                    $btnEdit = '<a href="'.route('product_group.edit', $dataDb->id).'"
                            data-tooltip-custom="tooltip" title="'.trans('global.update').'" >
                            <i class="flaticon-edit kt-font-brand"></i>
                            </a>
                            ';
                }

                if (Sentinel::inRole('root') || Sentinel::hasAccess(['product_group.destroy'])) {
                    $btnDelete = '<a href="#"
                                data-message="'.trans('auth.delete_confirmation', ['name' => $dataDb->name]).'"
                                data-href="'.route('product_group.destroy', $dataDb->id).'"
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
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * @param $request
     * @return mixed|void
     */
    public function select2($request)
    {
        // TODO: Implement select2() method.
        return $this->group->select2ByType($request, 'product');
    }

    /**
     * @param $request
     * @return mixed|void
     */
    public function queryProductGroups($request)
    {
        // TODO: Implement queryProductGroups() method.
        // TODO: Implement queryProducts() method.
        $select = [
            'product_id', 'group_id', 'created_at', 'updated_at'
        ];

        $dataDb = $this->model::select($select);

        return $dataDb;
    }

    public function getGroupById(int $id)
    {
        // TODO: Implement getGroupById() method.
        return $this->group->getGroupById($id);
    }
}
