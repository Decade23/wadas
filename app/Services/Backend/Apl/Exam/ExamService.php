<?php
/*
 * Created By Dedi Fardiyanto
 * Copyright (c) 2021, Inc - All Rights Reserved
 * @Filename ExamService.php
 * @LastModified 11/03/2021, 00:54
 */

namespace App\Services\Backend\Apl\Exam;


use App\Models\Apl\Exams\Exam;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class ExamService
 * @package App\Services\Backend\Apl\Exam
 */
class ExamService implements ExamServiceContract
{
    private $model, $productFolder;

    /**
     * ExamService constructor.
     */
    public function __construct(Exam $exam)
    {
        $this->model = $exam;
        $this->productFolder = 'exam';
    }

    /**
     * @param int $id
     */
    public function getById(int $id)
    {
        // TODO: Implement getById() method.
    }

    /**
     * @param $request
     */
    public function store($request)
    {
        // TODO: Implement store() method.
    }

    /**
     * @param $request
     */
    public function datatable($request)
    {
        // TODO: Implement datatable() method.
        return DataTables::eloquent($this->queryDatatable($request))
            ->addColumn('action', function ($dataDb){
                $btnShow = '';
                $btnEdit = '';
                $btnDelete = '';

                if (Sentinel::inRole('root') || Sentinel::hasAccess(['exam.show'])) {
                    $btnShow = '<a href="'.route('exam.show', $dataDb->id).'" >
                                <span class="label label-primary label-sm">
                                    <i class="fa fa-arrows-alt"></i>
                                </span>
                                </a>';
                }

                if (Sentinel::inRole('root') || Sentinel::hasAccess(['exam.edit'])) {
                    $btnEdit = '<a href="'.route('exam.edit', $dataDb->id).'">
                            <i class="flaticon-edit kt-font-brand"></i>
                            </a>
                            ';
                }

                if (Sentinel::inRole('root') || Sentinel::hasAccess(['exam.destroy'])) {
                    $btnDelete = '<a href="#"
                                data-message="'.trans('auth.delete_confirmation', ['name' => $dataDb->name]).'"
                                data-href="'.route('exam.destroy', $dataDb->id).'"
                                data-method="DELETE"
                                data-toggle="modal"
                                data-target="#delete">
                                <i class="flaticon-delete kt-font-danger"></i>
                    </a>';
                }
                return $btnShow;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * @param $request
     */
    public function queryDataTable($request)
    {
        // TODO: Implement queryDataTable() method.
        $select = [
            'exams.id', 'exams.title',
            DB::raw('1 as total_question'),
            'exams.visibility', 'exams.written_by', 'exams.created_at'
        ];

        $dataDb = $this->model::select($select)->with(['products','examDetails'])
            //->WithProduct()
            //->WithExamQuestionAndAnswer()
            //->groupBy('exams.title')
            ->orderBy('exams.created_at','DESC');

        return $dataDb;
    }
}
