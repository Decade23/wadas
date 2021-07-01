<?php
/*
 * Created By Dedi Fardiyanto
 * Copyright (c) 2021, Inc - All Rights Reserved
 * @Filename ExamController.php
 * @LastModified 11/03/2021, 18:20
 */

namespace App\Http\Controllers\Backend\Aplikasi;

use App\Http\Controllers\Controller;
use App\Services\Backend\Apl\Exam\ExamServiceContract;
use App\Traits\redirectTo;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    use redirectTo;

    private $service, $module, $pageTitle, $productFolder;

    public function __construct(ExamServiceContract $examServiceContract)
    {
        $this->service = $examServiceContract;
        $this->module = 'backend.apl.exam.';
        $this->pageTitle = 'Apl Exam';
        $this->productFolder = 'exam';
    }

    public function index() {

        $data['pageTitle'] = 'Exam';

        return view($this->module. 'index', $data);
    }

    public function datatable(Request $request)
    {
        #return $this->service->datatable($request);
        if ($request->ajax()) {
            return $this->service->datatable($request);
        }

        abort('404', 'Uups');
    }

    public function create() {
        $data['pageTitle'] = 'Create Exam';

        return view($this->module. 'create', $data);
    }

    public function store(Request $request) {

        if ( is_object( $this->service->store($request) ) ) {
            return $this->redirectSuccessCreate( route('exam.index'), 'Question Created!' );
        }

        return $this->redirectFailed( route('exam.create'), 'Question No Created Yet!' );

    }

    public function edit($id) {

        $data['pageTitle'] = 'Edit Exam';
        $data['dataDb'] = $this->service->getById($id);

        return view($this->module. 'edit.edit', $data);
    }
}
