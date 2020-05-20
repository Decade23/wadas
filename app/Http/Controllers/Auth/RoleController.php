<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Role\createRequest;
use App\Http\Requests\Auth\Role\updateRequest;
use App\Models\Auth\Role;
use App\Services\Auth\Role\RoleServiceContract;
use App\Traits\redirectTo;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    use redirectTo;

    private $service;

    /**
     * UserController constructor.
     */
    public function __construct(
        RoleServiceContract $roleServiceContract
    )
    {
        $this->service = $roleServiceContract;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('auth.roles.index');
    }

    public function create()
    {
        $permissions = [];

        return view('auth.roles.create', compact('permissions'));
    }

    public function store(createRequest $request)
    {
        #if success insert into DB
        if  (is_object($this->service->store($request))) {
            return $this->redirectSuccessCreate(route('roles.index'),'Success Created.');
        }

        #if fails insert into DB
        return $this->redirectFailed(route('roles.index'),'Error! Unsuccessfully. Fail to created.');
    }

    public function edit($id)
    {
        $dataDb = Role::find( $id );

        if ( empty( $dataDb ) || Sentinel::getUser()->roles[0]->slug !== 'root' && $this->restricted($dataDb->slug) ) {
            Session::flash( 'failed', 'Access Denied' );

            return redirect()->route('roles.index');
        }

        $permission = json_decode( json_encode( $dataDb->permissions ), true );

        return view( 'auth.roles.update', array(
            'dataDb'      => $dataDb,
            'permissions' => $permission
        ) );
    }

    public function update(updateRequest $request, $id)
    {
        #if success update into DB
        if  (is_object($this->service->update($id,$request))) {
            return $this->redirectSuccessUpdate(route('roles.index'),'Success Updated.');
        }

        #if fails update into DB
        return $this->redirectFailed(route('roles.index'),'Error! Unsuccessfully. Fail to updated.');
    }

    public function destroy($id)
    {
        #if success delete user
        if ($this->service->destroy($id)) {
            return $this->redirectSuccessDelete(route('roles.index'), 'Success Deleted.');
        }

        #if fails delete user
        return $this->redirectFailed(route('roles.index'),'Error! Unsuccessfully. Fail to deleted.');
    }

    public function status($id)
    {
        #if success updated status
        if ($this->service->status($id)) {
            return $this->redirectSuccessUpdate(route('roles.index'),'Success Updated Status.');
        }

        #can't deactivated user itself
        #if fails updated status
        return $this->redirectFailed(route('roles.index'),'Error! Unsuccessfully. Fail to updated status.');
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            return $this->service->datatable($request);
        }
        return abort('404', 'Uups');
    }

    public function select2(Request $request)
    {
        if ($request->ajax()) {
            return $this->service->select2($request);
        }

        return abort('404','Uups');
    }
}
