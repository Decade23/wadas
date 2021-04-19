<?php
/*
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename PostsService.php
 * @LastModified 24/09/2020, 01:03
 */

namespace App\Services\Frontend\Fulfillments\Posts;


use App\Models\Fulfillments\CommentPost;
use App\Models\Fulfillments\Posts;
use App\Models\Auth\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\DB;

/**
 * Class PostsService
 * @package App\Services\Frontend\Fulfillments\Posts
 */
class PostsFrontEndService implements PostsFrontEndServiceContract
{
    /**
     * @var Posts
     */
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
        return $this->model->get()->with('media');
    }

    public function getBySlug($slug)
    {
        // TODO: Implement getBySlug() method.
        return $this->model->with('media')->BySlug($slug)->ByVisibility('publish')->first();
    }

    public function getFourLatest()
    {
        // TODO: Implement getFourLatest() method.
        return $this->model->with('media')->latest()->limit(4)->get();
    }

    public function getDataVisitor($email)
    {
        // TODO: Implement getDataVisitor() method.
        return User::select(['name'])->ByEmail($email)->first();
    }

    public function storeCommentPost($request)
    {
        // TODO: Implement storeCommentPost() method.
        $userDb = '';
        if ( Sentinel::check() ) {
            $userDb = Sentinel::getUser()->id;
        } else if ( User::ByEmail($request->email)->count() ) {
            $userDb = User::ByEmail($request->email)->first()->id;
        }

        $postDb = $this->model->bySlug($request->slug)->first();

        DB::beginTransaction();
        try {

            #Save Comment
            $commentDb                 = new CommentPost();
            if ( $request->comment_id ) { $commentDb->comment_id     = $request->comment_id ?? ''; }

            if ( $userDb != '' ) {
                $commentDb->user_id    = $userDb;
            } else {
                $commentDb->name    = $request->name;
                $commentDb->email    = $request->email;
            }

            $commentDb->cms_post_id    = $postDb->id;
            $commentDb->comment        = $request->comment;

            $commentDb->save();


            DB::commit();

            return $commentDb;

        } catch (\Exception $exception) {
            DB::rollBack();

            dd($exception->getMessage() . ' ' . $exception->getLine()  . ' ' . $exception->getCode());
            return $exception->getCode();
        }
    }


}
