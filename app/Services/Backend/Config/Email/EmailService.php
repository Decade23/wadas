<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename EmailService.php
 * @LastModified 20/07/2020, 00:41
 */

namespace App\Services\Backend\Config\Email;


use App\Models\Config\Email;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class EmailService
 * @package App\Services\Backend\Config\Email
 */
class EmailService implements EmailServiceContract
{
    /**
     * @var Email
     */
    private $model;
    /**
     * EmailService constructor.
     */
    public function __construct(Email $email)
    {
        $this->model = $email;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        // TODO: Implement getById() method.
        return $this->model::find($id);
    }

    /**
     * @param $request
     * @return Email|int|mixed
     * @throws \Exception
     */
    public function store($request)
    {
        // TODO: Implement store() method.
        # retrieve
        $userDb = Sentinel::getUser()->email;

        DB::beginTransaction();
        try {
            # insert to product groups
            $insert = $this->model;
            $insert->fill($request->all());
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
            //dd($exception);
            //dd('Message: '.$exception->getMessage() . ' Line: ' . $exception->getLine()  . ' Code: ' . $exception->getCode());

            #return getCode Error
            return $exception->getCode();
        }
    }

    /**
     * @param int $id
     * @param $request
     * @return int|mixed
     * @throws \Exception
     */
    public function update(int $id, $request)
    {
        // TODO: Implement store() method.
        # retrieve
        $userDb = Sentinel::getUser()->email;

        DB::beginTransaction();
        try {
            # insert to product groups
            $update = $this->getById($id);
            $update->fill($request->all());
            $update->updated_by = $userDb;
            $update->save();

            # commit to insert to DB
            DB::commit();

            # return to controller
            return $update;

        } catch (\Exception $exception) {
            #rollback to begin (not insert to DB)
            DB::rollBack();
            #Dump
            //dd($exception);
            //dd('Message: '.$exception->getMessage() . ' Line: ' . $exception->getLine()  . ' Code: ' . $exception->getCode());

            #return getCode Error
            return $exception->getCode();
        }
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id)
    {
        // TODO: Implement destroy() method.
        return $this->model::find($id)->delete();
    }


    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse|mixed
     * @throws \Exception
     */
    public function datatable($request)
    {
        // TODO: Implement datatable() method.
        return DataTables::eloquent($this->queryDatatable($request))
            ->addColumn('action', function ($dataDb){
                $btnShow = '';
                $btnEdit = '';
                $btnDelete = '';

                if (Sentinel::inRole('root') || Sentinel::hasAccess(['config_email.show'])) {
                    $btnShow = '<a href="'.route('config_email.show', $dataDb->id).'" id="tooltip" data-tooltip-custom="tooltip" title="'.trans('global.show').'">
                            <span class="label label-primary label-sm">
                                <i class="fa fa-arrows-alt"></i>
                                </span>
                            </a>';
                }

                if (Sentinel::inRole('root') || Sentinel::hasAccess(['config_email.edit'])) {
                    $btnEdit = '<a href="'.route('config_email.edit', $dataDb->id).'">
                            <i class="flaticon-edit kt-font-brand"></i>
                            </a>
                            ';
                }

                if (Sentinel::inRole('root') || Sentinel::hasAccess(['config_email.destroy'])) {
                    $btnDelete = '<a href="#"
                                data-message="'.trans('auth.delete_confirmation', ['name' => $dataDb->name]).'"
                                data-href="'.route('config_email.destroy', $dataDb->id).'"
                                data-method="DELETE"
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
     * @return mixed
     */
    public function queryDatatable($request)
    {
        // TODO: Implement queryDatatable() method.
        $select = [
            'id', 'name', 'created_at', 'updated_at', 'created_by', 'updated_by', 'visibility'
        ];

        $dataDb = $this->model::select($select);
        return $dataDb;
    }

    /**
     * @param $request
     * @return int|mixed
     */
    public function select2($request)
    {
        // TODO: Implement select2() method.
        try {
            $perPage    = 10;
            $page       = $request->page ?? 1;

            Paginator::currentPageResolver(function() use($page) {
                return $page;
            });

            $dataDb = $this->model::select(['id', 'name as text'])->where('name', 'LIKE', '%' . $request->term . '%')->Visibility('publish')->orderBy('name')->paginate($perPage);

            return $dataDb;
        } catch (\Exception $exception) {

            // dd($exception->getMessage());
            return $exception->getCode();
        }
    }


}
