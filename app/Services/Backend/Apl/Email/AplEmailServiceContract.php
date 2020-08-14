<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename EmailServiceContract.php
 * @LastModified 21/07/2020, 03:10
 */

namespace App\Services\Backend\Apl\Email;


/**
 * Interface AplEmailServiceContract
 * @package App\Services\Backend\Apl\Email
 */
interface AplEmailServiceContract
{
    /**
     * @param int $id
     * @return mixed
     */
    public function getById(int $id);

    public function getByAttachmentId(int $id);

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
    public function select2($request);

    /**
     * @param $request
     * @return mixed
     */
    public function queryDataTable($request);

    public function tagify($request);

    public function tagifyGroup($request);
}
