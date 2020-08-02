<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename UserController.php
 * @LastModified 26/03/2020, 01:00
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\User\createRequest;
use App\Http\Requests\Auth\User\deleteRequest;
use App\Http\Requests\Auth\User\updateRequest;
use App\Models\Auth\Role;
use App\Services\Auth\Role\RoleServiceContract;
use App\Services\Auth\User\UserServiceContract;
use App\Traits\redirectTo;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/**
 * Class UserController
 * @package App\Http\Controllers\Auth
 */
class UserController extends Controller
{
    use redirectTo;

    private $service, $roleService;

    /**
     * UserController constructor.
     */
    public function __construct(
        UserServiceContract $userServiceContract,
        RoleServiceContract $roleServiceContract
    )
    {
        $this->service = $userServiceContract;
        $this->roleService = $roleServiceContract;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('auth.users.index');
    }

    public function create()
    {
        $roleDb = $this->roleService->getRole();

        return view('auth.users.create', compact('roleDb'));
    }

    public function store(createRequest $request)
    {
        #if success insert into DB
        if  (is_object($this->service->store($request))) {
            return $this->redirectSuccessCreate(route('user.index'),'Success Created.');
        }

        #if fails insert into DB
        return $this->redirectFailed(route('user.index'),'Error! Unsuccessfully. Fail to created.');
    }

    public function edit($id)
    {
        $user = Sentinel::findUserById( $id );

        #if user not found redirect back
        if ( empty( $user ) ) {
            Session::flash( 'failed', 'User Not Found' );
            return redirect()->route('user.index');
        }
        $roleDb = $this->roleService->getRole();
        $userRole = $user->roles[0]->id ?? null;

        return view('auth.users.update', array(
            'data'     => $user,
            'roleDb'   => $roleDb,
            'userRole' => $userRole
        ));
    }

    public function update(updateRequest $request, $id)
    {
        #if success update into DB
        if  (is_object($this->service->update($id,$request))) {
            return $this->redirectSuccessUpdate(route('user.index'),'Success Updated.');
        }

        #if fails update into DB
        return $this->redirectFailed(route('user.index'),'Error! Unsuccessfully. Fail to updated.');
    }

    public function destroy(deleteRequest $request, $id)
    {
        #retrieve user
        $user = Sentinel::findById( $id );

        #if user root can't delete
//        if (Sentinel::inRole( 'root' ) === true) {
//            return $this->redirectFailed(route('user.index'),'Error! Unsuccessfully. Something Went Wrong.');
//        }

        #if success delete user
        if ($this->service->destroy($user)) {
            return $this->redirectSuccessDelete(route('user.index'), 'Success Deleted.');
        }

        #if fails delete user
        return $this->redirectFailed(route('user.index'),'Error! Unsuccessfully. Fail to deleted.');
    }

    public function status($id)
    {
        #if success updated status
        if ($this->service->status($id)) {
            return $this->redirectSuccessUpdate(route('user.index'),'Success Updated Status.');
        }

        #can't deactivated user itself
        #if fails updated status
        return $this->redirectFailed(route('user.index'),'Error! Unsuccessfully. Fail to updated status.');
    }

    public function datatable(Request $request)
    {
        return $this->service->datatable($request);
    }

    public function select2(Request $request)
    {
        if ($request->ajax()) {
            return $this->service->select2($request);
        }

        return abort('404','Uups');
    }
}
