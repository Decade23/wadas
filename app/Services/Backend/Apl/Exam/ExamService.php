<?php
/*
 * Created By Dedi Fardiyanto
 * Copyright (c) 2021, Inc - All Rights Reserved
 * @Filename ExamService.php
 * @LastModified 11/03/2021, 00:54
 */

namespace App\Services\Backend\Apl\Exam;


use App\Models\Apl\Exams\Exam;
use App\Models\Apl\Exams\ExamAnswer;
use App\Models\Apl\Exams\ExamQuestion;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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
        return $this->model->find($id)->with(['examSingleDetails','singleProduct'])->first();
    }

    /**
     * @param $request
     */
    public function store($request)
    {
        # retrieve
        $userDb = Sentinel::getUser()->email;

        // TODO: Implement store() method.
        DB::beginTransaction();
        try {
            #insert into Exam
            $exam  = new Exam();
            $exam->product_id = $request->product;
            $exam->title = $request->title;
            $exam->slug = Str::slug($request->title,'-');
            $exam->desc = $request->desc;
            $exam->price = $request->price;
            $exam->written_by = $userDb;
            $exam->visibility = $request->visibility;
            $exam->save();

            #insert into exam question
            $exam_question = new ExamQuestion();
            $exam_question->exam_id = $exam->id;
            $exam_question->question = $request->question;
            $exam_question->answer = $request->answer['check'];
            $exam_question->written_by = $userDb;
            $exam_question->visibility = $request->visibility;
            $exam_question->save();

            #iterate answer
            #insert into exam answer
            foreach ( $request->answer['txt'] as $i => $v ) {

                $exam_answer = new ExamAnswer();
                $exam_answer->exam_question_id = $exam_question->id;
                $exam_answer->answer_type = $i;
                $exam_answer->answer_desc = $v;
                $exam_answer->written_by = $userDb;
                $exam_answer->visibility = $request->visibility;
                $exam_answer->save();

            }

            #commit to DB
            DB::commit();

            #if success return obj of exam
            return $exam;

        } catch (\Exception $exception) {
            report($exception);
            #dd($exception);
            return $exception->getMessage(). ' '. $exception->getLine(). ' '.$exception->getFile(). ' '.$exception->getCode();
        }
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
                return $btnShow. $btnEdit;
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
//            ->groupBy('exams.title')
            ->orderBy('exams.created_at','DESC');

        return $dataDb;
    }

    public function iterateAnswer(): object
    {
        // TODO: Implement iterateAnswer() method.

    }


}
