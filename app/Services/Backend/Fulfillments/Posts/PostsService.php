<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename PostsService.php
 * @LastModified 21/05/2020, 01:12
 */

namespace App\Services\Backend\Fulfillments\Posts;


use App\Models\Fulfillments\Posts;
use Yajra\DataTables\Facades\DataTables;

class PostsService implements PostsServiceContract
{

    private $model;
    /**
     * PostsService constructor.
     */
    public function __construct(Posts $posts)
    {
        $this->model = $posts;
    }

    public function datatable($request)
    {
        // TODO: Implement datatable() method.
        $query = $this->queryCmsPosts($request);

        return DataTables::eloquent($query)
            ->editColumn('created_at', function($dataDb) {
                return $dataDb->created_at->format('Y-m-d H:i:s');
            })
            ->editColumn('updated_at', function($dataDb) {
                return $dataDb->updated_at->format('Y-m-d H:i:s');
            })
//            ->addColumn(
//                'checkbox',
//                function ($dataDb) {
//                    return '<label class="kt-checkbox kt-checkbox--single kt-checkbox--solid kt-checkbox--brand"><input type="checkbox" value="'.$dataDb->id.'" class="kt-checkable"><span></span></label>'; //$dataDb->id;
//                }
//            )
            ->addColumn('action', function ($dataDb){
                $btnShow = '';
                $btnEdit = '';
                $btnDelete = '';

                if (Sentinel::inRole('root') || Sentinel::hasAccess(['post.show'])) {
                    $btnShow = '<a href="'.route('posts.show', $dataDb->id).'" id="tooltip" data-tooltip-custom="tooltip" title="'.trans('global.show').'">
                            <span class="label label-primary label-sm">
                                <i class="fa fa-arrows-alt"></i>
                                </span>
                            </a>';
                }

                if (Sentinel::inRole('root') || Sentinel::hasAccess(['post.edit'])) {
                    $btnEdit = '<a href="'.route('posts.edit', $dataDb->id).'"
                            data-tooltip-custom="tooltip" title="'.trans('global.update').'" >
                            <i class="flaticon-edit kt-font-brand"></i>
                            </a>
                            ';
                }

                if (Sentinel::inRole('root') || Sentinel::hasAccess(['post.destroy'])) {
                    $btnDelete = '<a href="#"
                                data-message="'.trans('auth.delete_confirmation', ['name' => $dataDb->name]).'"
                                data-href="'.route('posts.destroy', $dataDb->id).'"
                                data-method="DELETE"
                                title="'.trans('global.delete').'"
                                data-original-title="'.trans('global.delete').'"
                                data-title="'.trans('global.delete').'"
                                data-title-modal="Are u sure for delete this?"
                                data-toggle="modal"
                                data-target="#delete">
                                <i class="flaticon-delete kt-font-danger"></i>
                    </a>';
                }
                return $btnEdit . $btnDelete;
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function queryCmsPosts($request)
    {
        // TODO: Implement queryCmsPosts() method.
        $select = [
            'cms_posts.id', 'name', 'slug', 'short_content', 'content', 'mobile_content', 'written_by', 'cms_posts.product_id', 'cms_posts.counter',
            'cms_posts.created_at', 'cms_posts.updated_at'
        ];

        $dataDb = $this->model::select($select);

        return $dataDb;
    }


}
