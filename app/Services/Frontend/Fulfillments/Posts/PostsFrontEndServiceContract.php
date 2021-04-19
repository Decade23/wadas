<?php
/*
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename PostsServiceContract.php
 * @LastModified 24/09/2020, 01:03
 */

namespace App\Services\Frontend\Fulfillments\Posts;


/**
 * Interface PostsServiceContract
 * @package App\Services\Frontend\Fulfillments\Posts
 */
interface PostsFrontEndServiceContract
{
    /**
     * @return mixed
     */
    public function get();

    /**
     * @param $slug
     * @return mixed
     */
    public function getBySlug($slug);

    /**
     * @return mixed
     */
    public function getFourLatest();

    /**
     * @param $email
     * @return mixed
     */
    public function getDataVisitor($email);

    public function storeCommentPost($request);
}
