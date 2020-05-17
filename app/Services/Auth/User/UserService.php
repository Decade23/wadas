<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename UserService.php
 * @LastModified 26/03/2020, 00:24
 */

namespace App\Services\Auth\User;

use App\Models\Auth\User;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
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
            $userDb = Sentinel::getUser();
            $email = $request->email;

            #inserto into DB
            $data = [
                'name'       => $request->name,
                'phone'      => $request->phone,
                'email'      => strtolower( $email ),
                'password'   => $request->password,
                'created_by' => $userDb->name,
                'updated_by' => $userDb->name
            ];

            #create new user
            $user = Sentinel::registerAndActivate( $data );

            # attach user into role
            $role = Sentinel::findRoleById( $request->role );
            $role->users()->attach( $user );

            # commit to insert to DB
            DB::commit();

            # return to controller
            return $user;
        } catch (\Exception $exception) {
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
        $user = Sentinel::findById( $id );

        DB::beginTransaction();
        try {

            $oldRole = Sentinel::findRoleById( $user->roles[0]->id ?? null );

            $credentials = [
                'name'       => $request->name,
                'phone'      => $request->phone,
                'updated_by' => $user->name
            ];

            #If User Input Password
            if ( $request->password ) {
                $credentials['password'] = $request->password;
            }

            #Valid User For Update
            $role = Sentinel::findRoleById( $request->role );

            if ( $oldRole ) {
                #Remove a user from a role.
                $oldRole->users()
                    ->detach( $user );
            }

            #Assign a user to a role.
            $role->users()
                ->attach( $user );

            #Update User
            $updateIntoDb = Sentinel::update( $user, $credentials );
            DB::commit();

            return $updateIntoDb;

        } catch ( \Exception $exception ) {

            DB::rollBack();

            dd('Message: '.$exception->getMessage() . ' Line: ' . $exception->getLine()  . ' Code: ' . $exception->getCode());

            return $exception->getCode();
        }
    }

    /**
     * @param int $id
     * @return mixed|void
     */
    public function destroy($user)
    {
        // TODO: Implement destroy() method.
        return $user->delete();
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
                if ($dataDb->activations->isNotEmpty()) {
                    if ($dataDb->activations[0]->completed == 1) {
                        return '<a href="#" data-message="Are you sure you want to deactivate the user \''.$dataDb->name.'\' ?"
                    data-href="'.route('user.status', $dataDb->id).'"
                    data-title="Deactive This User"
                    data-title-modal="Deactive This User"
                    data-method="PUT"
                    data-toggle="modal"
                    data-target="#delete"
                    title="Deactive this user"><span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">Active</span></a>';
                    }
                }
                    return '<a href="#" data-message="Are you sure you want to activate the user \''.$dataDb->name.'\' ?"
                    data-href="'.route('user.status', $dataDb->id).'"
                    data-title="Activate This User"
                    data-title-modal="Activate This User"
                    data-method="PUT"
                    data-toggle="modal"
                    data-target="#delete"
                    title="Activated this user"><span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">Inactive</span></a>';

            })
            ->addColumn('role', function($dataDb) {
                if ($dataDb->roles->isNotEmpty()) {
                    return implode(', ', collect( $dataDb->roles )
                        ->pluck('name')
                        ->all() );
                }
            })
//            ->addColumn(
//                'checkbox',
//                function ($dataDb) {
//                    return '<label class="kt-checkbox kt-checkbox--single kt-checkbox--solid kt-checkbox--brand"><input type="checkbox" value="'.$dataDb->id.'" class="kt-checkable"><span></span></label>'; //$dataDb->id;
//                }
//            )
            ->addColumn('action', function ($dataDb){
                $btnShow = '<a href="'.route('user.show', $dataDb->id).'" id="tooltip" title="'.trans('global.show').'">
                            <span class="label label-primary label-sm">
                                <i class="fa fa-arrows-alt"></i>
                                </span>
                            </a>';

                $btnEdit = '<a href="'.route('user.edit', $dataDb->id).'"
                            data-tooltip-custom="tooltip" data-placement="left" title="Update It" >
                            <i class="flaticon-edit kt-font-brand"></i>
                            </a>
                            ';

                $btnDelete = '<a href="#"
                                data-message="Are u sure for delete this? '.$dataDb->name.'"
                                data-href="'.route('user.destroy', $dataDb->id).'"
                                data-method="DELETE"
                                title="delete"
                                data-original-title="Delete It?"
                                data-title="Delte It?"
                                data-title-modal="Are u sure for delete this?"
                                data-toggle="modal"
                                data-target="#delete">
                                <i class="flaticon-delete kt-font-danger"></i>
                    </a>';
                return $btnEdit . $btnDelete;
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function status(int $id)
    {
        // TODO: Implement status() method.
        $user = Sentinel::findById( $id );

        $activation = Activation::completed( $user );

        if ( $activation !== false ) {
            #Deactivated This Activation
            if ( $user->id === Sentinel::getUser()->id ) {
                return false;
            }

            #Remove this account
            Activation::remove( $user );
            return true;
        }

        #Deactivated This Activation
        if ( $user->id === Sentinel::getUser()->id ) {

            return false;
        }

        #Get Activation Code
        $activationCreate = Activation::create( $user );

        #Activate this account
        Activation::complete( $user, $activationCreate->code );

        return true;
    }


}
