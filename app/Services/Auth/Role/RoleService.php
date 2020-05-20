<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename RoleService.php
 * @LastModified 17/05/2020, 15:21
 */

namespace App\Services\Auth\Role;


use App\Models\Auth\Role;
use App\Models\Auth\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

/**
 * Class RoleService
 * @package App\Services\Auth\Role
 */
class RoleService implements RoleServiceContract
{
    /**
     * @var Role
     */
    protected $model;

    /**
     * RoleService constructor.
     */
    public function __construct(Role $role)
    {
        $this->model = $role;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        // TODO: Implement getRole() method.
        return $this->model->select('id', 'name')->get();
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
            'id','name', 'slug', 'created_by', 'updated_by', 'created_at', 'updated_at'
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
        # retrieve
        $userDb = Sentinel::getUser()->name;

        DB::beginTransaction();
        try {
            # insert to role
            $data             = new Role();
            $data->name       = $request->name;
            $data->slug       = Str::slug( $request->name );
            $data->created_by = $userDb;
            $data->updated_by = $userDb;

            /**
             *  Permission Here
             */
            $permissions       = collect( json_decode( $this->permissions( $request ) ) )->toArray();
            $data->permissions = $permissions;

            $data->save();

            # commit to insert to DB
            DB::commit();

            # return to controller
            return $data;
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

        DB::beginTransaction();
        try {
            $dataDb = Role::find( $id );

            if ( empty( $dataDb ) ) {
                Session::flash( 'failed', 'Access Denied' );

                return true;
            }

            $userDb             = Sentinel::getUser()->name;
            $dataDb->name       = $request->name;
            #many function use slug as identifier, not recommend for change it
            #$dataDb->slug       = Str::slug( $request->name );
            $dataDb->updated_by = $userDb;

            /**
             *  Permission Here
             */
            $permissions         = collect( json_decode( $this->permissions( $request ) ) )->toArray();
            $dataDb->permissions = $permissions;
            $dataDb->save();


            DB::commit();

            return $dataDb;

        } catch ( \Exception $exception ) {

            DB::rollBack();

            //dd('Message: '.$exception->getMessage() . ' Line: ' . $exception->getLine()  . ' Code: ' . $exception->getCode());

            return $exception->getCode();
        }
    }

    /**
     * @param int $id
     * @return mixed|void
     */
    public function destroy($id)
    {
        // TODO: Implement destroy() method.
        $userDb = Sentinel::getUser();
        $dataDb = Sentinel::findRoleById( $id );

        #if user root || data is empty || restricted role is can't delete
        if ( empty( $dataDb ) || $this->restricted($dataDb->slug) ) {

            return false;
        }

        $dataDb->users()
            ->detach( $userDb );
        $dataDb->delete();

        return $dataDb;
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
                return $dataDb->created_at->format('Y-m-d H:i:s');
            })
            ->editColumn('updated_at', function($dataDb) {
                return $dataDb->updated_at->format('Y-m-d H:i:s');
            })
           ->addColumn('action', function ($dataDb){
               $btnShow = '';
               $btnEdit = '';
               $btnDelete = '';

               if (Sentinel::inRole('root') || Sentinel::hasAccess(['role.show'])) {
                   $btnShow = '<a href="'.route('roles.show', $dataDb->id).'" id="tooltip" title="Show">
                            <span class="label label-primary label-sm">
                                <i class="fa fa-arrows-alt"></i>
                                </span>
                            </a>';
               }

               if (Sentinel::inRole('root') || Sentinel::hasAccess(['role.edit'])) {
                   $btnEdit = '<a href="'.route('roles.edit', $dataDb->id).'"
                            data-tooltip-custom="tooltip" data-placement="left" title="Update It" >
                            <i class="flaticon-edit kt-font-brand"></i>
                            </a>
                            ';
               }

               if (Sentinel::inRole('root') || Sentinel::hasAccess(['role.destroy'])) {
                   $btnDelete = '<a href="#"
                                data-message="Are u sure for delete this? '.$dataDb->name.'"
                                data-href="'.route('roles.destroy', $dataDb->id).'"
                                data-method="DELETE"
                                title="delete"
                                data-original-title="Delete It?"
                                data-title="Delte It?"
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
     * @return mixed
     */
    public function select2($request)
    {
        // TODO: Implement select2() method.
        $perPage    = 10;
        $page       = $request->page ?? 1;

        Paginator::currentPageResolver(function() use($page) {
            return $page;
        });

        $dataDb = Role::select(['id', 'name as text'])->where('name', 'LIKE', '%' . $request->term . '%')->orderBy('name')->paginate($perPage);

        return $dataDb;
    }

    private function permissions( $request ) {

        //Dashboard
        $permissions['dashboard'] = true;

        $request = $request->except( array( '_token', 'name', '_method', 'previousUrl' ) );

        foreach ( $request as $key => $value ) {
            $permissions[ preg_replace( '/_([^_]*)$/', '.\1', $key ) ] = true;
        }

        return json_encode( $permissions );
    }

    private function restricted($slug){
        return $slug == 'root' || $slug == 'member' || $slug == 'sales';
    }
}
