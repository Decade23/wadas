<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename PostsServiceContract.php
 * @LastModified 21/05/2020, 01:12
 */

namespace App\Services\Backend\Fulfillments\Posts;


interface PostsServiceContract
{
    public function datatable($request);

    public function queryCmsPosts($request);
}
