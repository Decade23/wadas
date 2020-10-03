<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename PostsServiceContract.php
 * @LastModified 21/05/2020, 01:12
 */

namespace App\Services\Backend\Fulfillments\Posts;


/**
 * Interface PostsServiceContract
 * @package App\Services\Backend\Fulfillments\Posts
 */
interface PostsServiceContract
{
    /**
     * @return mixed
     */
    public function get();

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id);

    /**
     * @param $request
     * @return mixed
     */
    public function store($request);

    /**
     * @param int $id
     * @param $request
     * @return mixed
     */
    public function update(int $id, $request);

    /**
     * @param $request
     * @return mixed
     */
    public function datatable($request);

    /**
     * @param $request
     * @return mixed
     */
    public function queryCmsPosts($request);
}
