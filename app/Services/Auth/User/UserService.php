<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename UserService.php
 * @LastModified 26/03/2020, 00:24
 */

namespace App\Services\Auth\User;

use App\Models\Auth\User;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use function foo\func;

/**
 * Class UserService
 * @package App\Services\Auth\User
 */
class UserService implements UserServiceContract
{
    /**
     * @var User
     */
    private $model;

    /**
     * UserService constructor.
     */
    public function __construct(
        User $user
    )
    {
        $this->model = $user;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function get(int $id)
    {
        // TODO: Implement get() method.
        $dataDb = $this->model::find($id);

        return $dataDb;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getData($request)
    {
        // TODO: Implement getData() method.
        $select = [
            'id', 'email', 'last_login', 'name', 'phone', 'type', 'gender', 'created_by', 'updated_by', 'created_at', 'updated_at'
        ];

        $dataDb = $this->model::select($select);

        return $dataDb;
    }

    /**
     * @param $request
     * @return int|mixed|string
     * @throws \Exception
     */
    public function store($request)
    {
        // TODO: Implement store() method.
        DB::beginTransaction();
        try {
            # logic to insert to DB

            # commit to insert to DB
            DB::commit();

            # return to controller
            return '';
        } catch (\Exception $e) {
            #rollback to begin (not insert to DB)
            DB::rollBack();

            #Dump
            dd('Message: '.$exception->getMessage() . ' Line: ' . $exception->getLine()  . ' Code: ' . $exception->getCode());

            #return getCode Error
            return $e->getCode();
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
    }

    /**
     * @param int $id
     * @return mixed|void
     */
    public function destroy(int $id)
    {
        // TODO: Implement destroy() method.
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
     * @return \Illuminate\Http\JsonResponse|mixed
     * @throws \Exception
     */
    public function datatable($request)
    {
        // TODO: Implement datatable() method.
        $query = $this->getData($request);

        return DataTables::eloquent($query)
            ->editColumn('created_at', function($dataDb) {
                return $dataDb->created_at->format('d M Y H:i:s');
            })
            ->editColumn('updated_at', function($dataDb) {
                return $dataDb->updated_at->format('d M Y H:i:s');
            })
            ->addColumn('status', function($dataDb) {
                if ($dataDb->activations[0]->completed == 1) {
                    return '<a href="#" data-message="Not Active This User: '.$dataDb->name.'" data-href="'.route('user.status', $dataDb->id).'" data-toggle="kt-tooltip" title="Deactive this user"><span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">Active</span></a>';
                } else {
                    return '<a href="#"><span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">Not Active</span></a>';
                }
            })
            ->addColumn('role', function($dataDb) {
                if ($dataDb->roles->isNotEmpty()) {
                    return implode(', ', collect( $dataDb->roles )
                        ->pluck('name')
                        ->all() );
                }
            })
            ->addColumn(
                'checkbox',
                function ($dataDb) {
                    return '<label class="kt-checkbox kt-checkbox--single kt-checkbox--solid kt-checkbox--brand"><input type="checkbox" value="'.$dataDb->id.'" class="kt-checkable"><span></span></label>'; //$dataDb->id;
                }
            )
            ->addColumn('action', function ($dataDb){
                return '<a href="'.route('user.edit', $dataDb->id).'"
                            id="tooltip" title="Edit" >
                            <span class="label label-success label-sm">
                            <i class="fa fa-file-pdf-o">
                            </i></span>
                            </a>
                            <a href="'.route('user.show', $dataDb->id).'" id="tooltip" title="'.trans('global.show').'">
                            <span class="label label-primary label-sm">
                                <i class="fa fa-arrows-alt"></i>
                                </span>
                            </a>
                            <a href="#"
                                data-message="'.trans('auth.delete_confirmation', ['name' => $dataDb->name]).'"
                                data-href="'.route('user.destroy', $dataDb->id).'"
                                id="tooltip" data-method="DELETE"
                                data-title="'.trans('global.delete').'"
                                data-toggle="modal" data-target="#delete">
                                <span class="label label-danger label-sm">
                                <i class="fa fa-trash-o"></i>
                                </span>
                    </a>';
            })
            ->rawColumns(['checkbox','action', 'status'])
            ->make(true);
    }


}
