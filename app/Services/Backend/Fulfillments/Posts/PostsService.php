<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename PostsService.php
 * @LastModified 21/05/2020, 01:12
 */

namespace App\Services\Backend\Fulfillments\Posts;


use App\Models\Fulfillments\Posts;
use App\Models\Media;
use App\Services\Backend\Media\MediaServicesContract;
use App\Traits\fileUploadTrait;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class PostsService
 * @package App\Services\Backend\Fulfillments\Posts
 */
class PostsService implements PostsServiceContract
{

    /**
     * @var Posts
     */
    /**
     * @var Posts|MediaServicesContract
     */
    /**
     * @var Posts|MediaServicesContract|string
     */
    private $model, $media, $productFolder;
    use fileUploadTrait;

    /**
     * PostsService constructor.
     */
    public function __construct(Posts $posts, MediaServicesContract $mediaServicesContract)
    {
        $this->model = $posts;
        $this->media = $mediaServicesContract;
        $this->productFolder = 'cms_posts';
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        // TODO: Implement getById() method.
        return $this->model->find($id);
    }

    /**
     * @param $request
     * @return Posts|MediaServicesContract|int|mixed|string
     * @throws \Exception
     */
    public function store($request)
    {
        // TODO: Implement store() method.
        $userDb = Sentinel::getUser()->email;
        DB::beginTransaction();
        try {
            # insert to product groups
            $insert = $this->model;
            $insert->fill($request->all());
            $insert->slug = Str::slug($request->name, '-');
            $insert->visibility = $request->visibility;

            if ($request->has('product'))
            {
                $insert->product_id = $request->product;
            }

            $insert->counter    = 0; //default counter is 0
            $insert->written_by = $userDb;
            $insert->save();

            #insert media (image)
            if (is_array($request->document)) {
                foreach ($request->document as $file_name) {
                    $path   = 'public/'. $this->uploadPath .'/'.  $this->productFolder . '/'. $file_name;
                    $url    = Storage::disk('s3')->url($path);
                    $files[] = [
                        'type'  => 'image',
                        'model' => 'Posts',
                        'url'   => $url,
                        'path'  => $path,
                        'file_name' => $file_name
                    ];
                }
                $this->saveMedia($files, $insert->id);
            }

            # commit to insert to DB
            DB::commit();

            # return to controller
            return $insert;

        } catch (\Exception $exception) {
            #rollback to begin (not insert to DB)
            DB::rollBack();
            #Dump
            #dd($exception);
            //dd('Message: '.$exception->getMessage() . ' Line: ' . $exception->getLine()  . ' Code: ' . $exception->getCode());

            #return getCode Error
            return $exception->getCode();
        }
    }

    /**
     * @param int $id
     * @param $request
     * @return int|mixed
     * @throws \Exception
     */
    public function update(int $id, $request)
    {
        // TODO: Implement update() method.
        //dd($request->all());
        # retrieve
        $userDb = Sentinel::getUser()->email;

        DB::beginTransaction();
        try {
            # insert to product groups
            $insert = $this->model::find($id);
            $insert->fill($request->all());
            $insert->slug = Str::slug($request->name, '-');
            $insert->visibility = $request->visibility;

            if ($request->has('product'))
            {
                $insert->product_id = $request->product;
            }

            $insert->updated_by = $userDb;
            $insert->save();

            #insert media (image)
            if (is_array($request->document)) {
                foreach ($request->document as $file_name) {
                    $path   = 'public/'. $this->uploadPath .'/'.  $this->productFolder . '/'. $file_name;
                    $url    = Storage::disk('s3')->url($path);
                    $files[] = [
                        'type'  => 'image',
                        'model' => 'Posts',
                        'url'   => $url,
                        'path'  => $path,
                        'file_name' => $file_name
                    ];
                }
                $this->updateMedia($files, $insert->id);
            }

            # commit to insert to DB
            DB::commit();

            # return to controller
            return $insert;

        } catch (\Exception $exception) {
            #rollback to begin (not insert to DB)
            DB::rollBack();
            #Dump
            dd($exception);
            //dd('Message: '.$exception->getMessage() . ' Line: ' . $exception->getLine()  . ' Code: ' . $exception->getCode());

            #return getCode Error
            return $exception->getCode();
        }
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id)
    {
        // TODO: Implement destroy() method.
        $post = $this->model->find($id);
        $this->media->deleteMediaByItemId($id);
        return $post->delete();
    }


    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
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
                    $btnShow = '<a href="'.route('posts.show', $dataDb->id).'" >
                            <span class="label label-primary label-sm">
                                <i class="fa fa-arrows-alt"></i>
                                </span>
                            </a>';
                }

                if (Sentinel::inRole('root') || Sentinel::hasAccess(['post.edit'])) {
                    $btnEdit = '<a href="'.route('posts.edit', $dataDb->id).'" >
                            <i class="flaticon-edit kt-font-brand"></i>
                            </a>
                            ';
                }

                if (Sentinel::inRole('root') || Sentinel::hasAccess(['post.destroy'])) {
                    $btnDelete = '<a href="#"
                                data-message="'.trans('auth.delete_confirmation', ['name' => $dataDb->name]).'"
                                data-href="'.route('posts.destroy', $dataDb->id).'"
                                data-method="DELETE"
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

    /**
     * @param $request
     * @return mixed
     */
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

    /**
     * @param $request
     * @param $productId
     * @return array
     */
    private function saveMedia($request, $productId)
    {
        #delete existing file
        $this->destroyMedia($productId);

        $imagesDb = [];
        #insert new media into db
        foreach ($request as $image) {
            $imagesDb[] = Media::create([
                'type'      => $image['type'],
                'item_id'   => $productId,
                'url'       => $image['url'],
                'model'     => $image['model'],
                'path'      => $image['path'],
                'file_name'  => $image['file_name'],
                'created_by'  => Sentinel::getUser()->email,
                'updated_by'  => Sentinel::getUser()->email
            ]);
        }

        return $imagesDb;
    }

    /**
     * @param $productId
     * @return mixed
     */
    private function destroyMedia($productId)
    {
        //Media::where('item_id', $productId)->delete();
        return $this->media->deleteMediaByItemId($productId);

    }

    /**
     * @param $request
     * @param $productId
     * @return array
     */
    private function updateMedia($request, $productId)
    {

        #check if file is same
        $imagesDb = [];
        #insert new media into db

        foreach ($request as $image) {
            #if file not same with the old one
            $fileDb = $this->media->getMediaByFileName($image['file_name']);
            if ( !isset($fileDb->file_name) ) {
                $imagesDb[] = Media::create([
                    'type'      => $image['type'],
                    'item_id'   => $productId,
                    'url'       => $image['url'],
                    'model'     => $image['model'],
                    'path'      => $image['path'],
                    'file_name'  => $image['file_name'],
                    'created_by'  => Sentinel::getUser()->email,
                    'updated_by'  => Sentinel::getUser()->email
                ]);
            } else if ($fileDb->file_name != $image['file_name']) {
                # if file exist in db then delete it
                $this->media->deleteMediaByFileName($fileDb->file_name);
            }
        }

        return $imagesDb;
    }
}
