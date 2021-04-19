<?php
/*
 * Created By Dedi Fardiyanto
 * Copyright (c) 2021, Inc - All Rights Reserved
 * @Filename ExamServiceContract.php
 * @LastModified 11/03/2021, 00:59
 */

namespace App\Services\Backend\Apl\Exam;


/**
 * Interface ExamServiceContract
 * @package App\Services\Backend\Apl\Exam
 */
interface ExamServiceContract
{
    /**
     * @param int $id
     * @return mixed
     */
    public function getById(int $id);

    /**
     * @param $request
     * @return mixed
     */
    public function store($request);

    /**
     * @param $request
     * @return mixed
     */
    public function datatable($request);

    /**
     * @param $request
     * @return mixed
     */
    public function queryDataTable($request);
}
