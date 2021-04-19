<?php

namespace App\Http\Controllers\Frontend\Fulfillments;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Fulfillments\postsCommentRequest;
use App\Services\Backend\Fulfillments\Posts\PostsServiceContract;
use App\Services\Frontend\Fulfillments\Posts\PostsFrontEndServiceContract;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    private $service, $module, $titlePage;

    public function __construct(PostsFrontEndServiceContract $postsFrontEndServiceContract)
    {
        $this->service = $postsFrontEndServiceContract;
        $this->titlePage = config('app.name');
        $this->module = 'frontend.pages.fulfillments.posts.';
    }

    public function show($slug)
    {
        $data['dataDb'] = $this->service->getBySlug($slug);
        $data['page_title'] = $this->titlePage. ' | '. ucwords( $data['dataDb']->name );
        #$data['footer_title_page'] = $this->titlePage. ' | '. ucwords( $data['dataDb']->name );

        #seo
        $data['seo_author'] = ucwords( $data['dataDb']->author->name ) ?? 'Team '. $this->titlePage;
        $data['seo_keywords'] = ucwords( $data['dataDb']->author->name );
        $data['seo_description'] = ucwords( $data['dataDb']->short_content );
        $data['seo_og_site_name'] = ucwords( $data['page_title'] );
        $data['seo_og_title'] = ucwords( $data['dataDb']->name );
        $data['seo_og_description'] = ucwords( $data['dataDb']->content );


        return view($this->module.'show', $data );
    }

    public function store_comment(postsCommentRequest $request)
    {
        if ( $request->ajax() === true ) {
            $data['res'] = $this->service->storeCommentPost($request);
            $data['message'] = 'Comment Success. status comment is pending for our staff to checking it';
            return response()->json($data,'200');
        }

        abort('404', 'Uups');
    }

    public function get_data_visitor(Request $request)
    {
        if ($request->ajax() === true) {
            $data = $this->service->getDataVisitor($request->email) !== null ? $this->service->getDataVisitor($request->email) : '';
            return response()->json([
                'success' => $data
            ]);
        }

        abort('400', 'Bad Request');
    }


}
