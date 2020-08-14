<?php

namespace App\Http\Controllers\Backend\Aplikasi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Apl\Email\emailRequest;
use App\Services\Backend\Apl\Email\AplEmailServiceContract;
use App\Services\Backend\Config\Email\EmailServiceContract;
use App\Services\Backend\Media\MediaServicesContract;
use App\Traits\redirectTo;
use Illuminate\Http\Request;

/**
 * Class AplEmailController
 * @package App\Http\Controllers\Backend\Aplikasi
 */
class AplEmailController extends Controller
{
    use redirectTo;

    /**
     * @var AplEmailServiceContract
     */
    /**
     * @var AplEmailServiceContract|string
     */
    private $service, $module, $pageTitle, $productFolder;
    /**
     * EmailController constructor.
     */
    public function __construct(AplEmailServiceContract $aplEmailServiceContract)
    {
        $this->service = $aplEmailServiceContract;
        $this->module = 'backend.apl.email.';
        $this->pageTitle = 'Apl Email';
        $this->productFolder = 'email';
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data['pageTitle'] = 'Email';

        return view($this->module. 'index', $data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $data['pageTitle'] = 'Send Email';

        return view($this->module. 'create', $data);
    }

    /**
     * @param configEmailRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(emailRequest $request)
    {
//        dd($request->all());
        #if success insert into DB
        if  (is_object($this->service->store($request))) {
            return $this->redirectSuccessCreate(route('apl_email.index'),'Success Send Email.');
        }

        #if fails insert into DB
        return $this->redirectFailed(route('apl_email.create'),'Error! Unsuccessfully. Fail to created.');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $data['pageTitle']              = 'Show Email';
        $data['dataDb']['compose']      = $this->service->getById($id);
        #$data['dataDb']['attachments']  = $this->service->getByAttachmentId($id);
        //$data = (object) $data['dataDb']; #convert array to object with cast

        //$data['attachment'] = implode(',', json_encode( $data['dataDb']->attachment ) );
        //dd( $data['dataDb']['compose']->attachments_media );
        // dd( $this->service->getByAttachmentId($id) );

        return view($this->module. 'show', $data);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function datatable(Request $request)
    {
        #return $this->service->datatable($request);
        if ($request->ajax()) {
            return $this->service->datatable($request);
        }

        abort('404', 'Uups');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function select2(Request $request)
    {

        if ($request->ajax()) {
            return $this->service->select2($request);
        }

        abort('404', 'Uups');
    }

    public function tagify(Request $request)
    {

        if ($request->ajax()) {
            return $this->service->tagify($request);
        }

        abort('404', 'Uups');
    }

    public function tagifyGroup(Request $request)
    {

        if ($request->ajax()) {
            return $this->service->tagifyGroup($request);
        }

        abort('404', 'Uups');
    }

    public function select2Config(Request $request, EmailServiceContract $emailServiceContract)
    {
        if ($request->ajax()) {
            return $emailServiceContract->select2($request);
        }

        abort('404', 'Uups');
    }

    public function imageUpload(Request $request, MediaServicesContract $mediaServicesContract)
    {
        return $mediaServicesContract->storeMedia($request, $this->productFolder,'');
    }

    public function retrieveImageCreateUpload(Request $request, MediaServicesContract $mediaServicesContract)
    {
        # retrieve image
        return $mediaServicesContract->retrieveUploadCreateFiles($request, $this->productFolder);
    }

    public function deleteImageUpload(Request $request, MediaServicesContract $mediaServicesContract)
    {
        return $mediaServicesContract->deleteMediaFromProvider($request->name,$this->productFolder);
    }
}
