<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename EmailService.php
 * @LastModified 21/07/2020, 03:10
 */

namespace App\Services\Backend\Apl\Email;


use App\Models\Apl\AplEmail;
use App\Models\Auth\User;
use Illuminate\Pagination\Paginator;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class AplEmailService
 * @package App\Services\Backend\Apl\Email
 */
class AplEmailService implements AplEmailServiceContract
{
    /**
     * @var AplEmail
     */
    private $model;
    /**
     * AplEmailService constructor.
     */
    public function __construct(AplEmail $aplEmail)
    {
        $this->model = $aplEmail;
    }

    /**
     * @param int $id
     * @return mixed|void
     */
    public function getById(int $id)
    {
        // TODO: Implement getById() method.
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

                if (Sentinel::inRole('root') || Sentinel::hasAccess(['apl_email.show'])) {
                    $btnShow = '<a href="'.route('apl_email.show', $dataDb->id).'" id="tooltip" data-tooltip-custom="tooltip" title="'.trans('global.show').'">
                            <span class="label label-primary label-sm">
                                <i class="fa fa-arrows-alt"></i>
                                </span>
                            </a>';
                }

                if (Sentinel::inRole('root') || Sentinel::hasAccess(['apl_email.edit'])) {
                    $btnEdit = '<a href="'.route('apl_email.edit', $dataDb->id).'">
                            <i class="flaticon-edit kt-font-brand"></i>
                            </a>
                            ';
                }

                if (Sentinel::inRole('root') || Sentinel::hasAccess(['apl_email.destroy'])) {
                    $btnDelete = '<a href="#"
                                data-message="'.trans('auth.delete_confirmation', ['name' => $dataDb->name]).'"
                                data-href="'.route('apl_email.destroy', $dataDb->id).'"
                                data-method="DELETE"
                                data-toggle="modal"
                                data-target="#delete">
                                <i class="flaticon-delete kt-font-danger"></i>
                    </a>';
                }
                return $btnShow . $btnDelete;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function queryDataTable($request)
    {
        // TODO: Implement queryDataTable() method.
        $select = [
            'id', 'recipient', 'title', 'created_by', 'updated_by', 'created_at', 'updated_at'
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
        try {
            $perPage    = 10;
            $page       = $request->page ?? 1;

            Paginator::currentPageResolver(function() use($page) {
                return $page;
            });

            $dataDb = $this->model::select(['id', 'title as text'])->where('title', 'LIKE', '%' . $request->term . '%')->orderBy('name')->paginate($perPage);

            return $dataDb;
        } catch (\Exception $exception) {

            // dd($exception->getMessage());
            return $exception->getCode();
        }
    }

    public function tagify($request)
    {
        // TODO: Implement tagify() method.
        try {
            $perPage    = 10;
            $page       = $request->page ?? 1;

            Paginator::currentPageResolver(function() use($page) {
                return $page;
            });

            $dataDb = User::select(['id', 'email as text'])->where('email', 'LIKE', '%' . $request->term . '%')->Type('customer')->orderBy('id', 'desc')->paginate($perPage);

            return $dataDb;
        } catch (\Exception $exception) {

            // dd($exception->getMessage());
            return $exception->getCode();
        }
    }


}
