<?php
/*
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename PostsService.php
 * @LastModified 24/09/2020, 01:03
 */

namespace App\Services\Frontend\Fulfillments\Posts;


use App\Models\Fulfillments\Posts;

/**
 * Class PostsService
 * @package App\Services\Frontend\Fulfillments\Posts
 */
class PostsFrontEndService implements PostsFrontEndServiceContract
{
    private $model;
    /**
     * PostsService constructor.
     */
    public function __construct(Posts $posts)
    {
        $this->model = $posts;
    }

    /**
     * @return mixed|void
     */
    public function get()
    {
        // TODO: Implement get() method.
        return $this->model->get();
    }

}
