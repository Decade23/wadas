<?php

namespace App\Http\Controllers\Backend\Config;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Config\Email\configEmailRequest;
use App\Services\Backend\Config\Email\EmailServiceContract;
use App\Traits\redirectTo;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    use redirectTo;

    private $service, $module;
    /**
     * EmailController constructor.
     */
    public function __construct(EmailServiceContract $emailServiceContract)
    {
        $this->service = $emailServiceContract;
        $this->module = 'backend.config.email.';
    }

    public function index()
    {
        $data['pageTitle'] = 'Email';

        return view($this->module. 'index', $data);
    }

    public function create()
    {
        $data['pageTitle'] = 'Create Email';

        return view($this->module. 'create', $data);
    }

    public function store(configEmailRequest $request)
    {

        #if success insert into DB
        if  (is_object($this->service->store($request))) {
            return $this->redirectSuccessCreate(route('config_email.index'),'Success Created.');
        }

        #if fails insert into DB
        return $this->redirectFailed(route('config_email.create'),'Error! Unsuccessfully. Fail to created.');
    }

    public function edit($id)
    {
        $data['pageTitle'] = 'Update Email';
        $data['dataDb'] = $this->service->getById($id);

        return view($this->module. 'edit', $data);
    }

    public function update(configEmailRequest $request, $id)
    {
        #if success update into DB

        if  (is_object($tes = $this->service->update($id,$request))) {

            return $this->redirectSuccessUpdate(route('config_email.index'),'Success Updated.');
        }

        #if fails update into DB
        return $this->redirectFailed(route('config_email.index'),'Error! Unsuccessfully. Fail to updated.');
    }

    public function destroy($id)
    {
        #if success delete product
        if ($this->service->destroy($id)) {
            return $this->redirectSuccessDelete(route('config_email.index'), 'Success Deleted.');
        }

        #if fails delete product
        return $this->redirectFailed(route('config_email.index'),'Error! Unsuccessfully. Fail to deleted.');
    }

    public function datatable(Request $request)
    {
        #return $this->service->datatable($request);
        if ($request->ajax()) {
            return $this->service->datatable($request);
        }

        abort('404', 'Uups');
    }
}
