<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename ProductServices.php
 * @LastModified 01/06/2020, 03:59
 */

namespace App\Services\Backend\Products\Product;


use App\Models\Groups;
use App\Models\Media;
use App\Models\Products\Product;
use App\Services\Backend\Media\MediaServicesContract;
use App\Traits\fileUploadTrait;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class ProductServices
 * @package App\Services\Backend\Products\Product
 */
class ProductServices implements ProductServicesContract
{
    /**
     * @var Product
     */
    /**
     * @var Product|MediaServicesContract
     */
    /**
     * @var Product|MediaServicesContract|string
     */
    private $model, $media, $productFolder;
    use fileUploadTrait;

    /**
     * ProductServices constructor.
     */
    public function __construct(Product $product, MediaServicesContract $mediaServicesContract)
    {
        $this->model = $product;
        $this->media = $mediaServicesContract;
        $this->productFolder = 'media';
    }

    /**
     * @return mixed|void
     */
    public function get()
    {
        // TODO: Implement get() method.
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getById($id)
    {
        // TODO: Implement getById() method.
        return $this->model::find($id);
    }

    /**
     * @param $request
     * @return Product|int|mixed
     * @throws \Exception
     */
    public function store($request)
    {
        // TODO: Implement store() method.
        # retrieve
        $userDb = Sentinel::getUser()->email;

        DB::beginTransaction();
        try {
            # insert to product groups
            $insert = new Product();
            $insert->fill($request->all());
            $insert->slug = Str::slug($request->name, '-');
            $insert->created_by = $userDb;
            $insert->updated_by = $userDb;
            $insert->save();

            #attach to groups
            $insert->groups()->attach($request->group);

            #insert media (image)
            if (is_array($request->document)) {
                foreach ($request->document as $file_name) {
                    $path   = 'public/'. $this->uploadPath .'/'. 'media'. '/'. $file_name;
                    $url    = Storage::disk('s3')->url($path);
                    $files[] = [
                        'type'  => 'image',
                        'model' => 'Product',
                        'url'   => $url,
                        'path'  => $path,
                        'file_name' => $file_name
                    ];
                }
                $this->saveProductImages($files, $insert->id);
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
            $insert->type = Groups::find($request->group)->name;
            $insert->updated_by = $userDb;
            $insert->save();

            #attach to groups
            $insert->groups()->sync($request->group);

            #insert media (image)
            if (is_array($request->document)) {
                foreach ($request->document as $file_name) {
                    $path   = 'public/'. $this->uploadPath .'/'. 'media'. '/'. $file_name;
                    $url    = Storage::disk('s3')->url($path);
                    $files[] = [
                        'type'  => 'image',
                        'model' => 'Product',
                        'url'   => $url,
                        'path'  => $path,
                        'file_name' => $file_name
                    ];
                }
                $this->updateProductImages($files, $insert->id);
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
        $product = Product::find($id);
        $this->media->deleteMediaByItemId($id);
        return $product->delete();
    }

    /**
     * @param array $id
     * @return mixed|void
     */
    public function destroyBulk(array $id)
    {
        // TODO: Implement destroyBulk() method.
    }

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse|mixed
     * @throws \Exception
     */
    public function datatable($request)
    {
        // TODO: Implement datatable() method.
        $query = $this->queryProducts($request);

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
            ->addColumn('group_name', function ($dataDb){
                $grup = '';
                $arr = Array();
                foreach($dataDb->groups as $group){
                    $arr[] = $group->name;
                    $grup = implode(', ', $arr);
                }
                return $grup;
            })
            ->addColumn('action', function ($dataDb){
                $btnShow = '';
                $btnEdit = '';
                $btnDelete = '';

                if (Sentinel::inRole('root') || Sentinel::hasAccess(['product.show'])) {
                    $btnShow = '<a href="'.route('product.show', $dataDb->id).'" id="tooltip" data-tooltip-custom="tooltip" title="'.trans('global.show').'">
                            <span class="label label-primary label-sm">
                                <i class="fa fa-arrows-alt"></i>
                                </span>
                            </a>';
                }

                if (Sentinel::inRole('root') || Sentinel::hasAccess(['product.edit'])) {
                    $btnEdit = '<a href="'.route('product.edit', $dataDb->id).'"
                             title="'.trans('global.update').'" >
                            <i class="flaticon-edit kt-font-brand"></i>
                            </a>
                            ';
                }

                if (Sentinel::inRole('root') || Sentinel::hasAccess(['product.destroy'])) {
                    $btnDelete = '<a href="#"
                                data-message="'.trans('auth.delete_confirmation', ['name' => $dataDb->name]).'"
                                data-href="'.route('product.destroy', $dataDb->id).'"
                                data-method="DELETE"
                                title="'.trans('global.delete').'"
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
    public function select2($request)
    {
        // TODO: Implement select2() method.
        $perPage    = 10;
        $page       = $request->page ?? 1;

        Paginator::currentPageResolver(function() use($page) {
            return $page;
        });

        $dataDb = $this->model::select(['id', DB::raw("concat(name, ' (', type, ')') as text"), 'name', 'type','time_period', 'price'])->with(['groups'])->where('name', 'LIKE', '%' . $request->term . '%')->orderBy('created_at', 'DESC')->orderBy('name')->paginate($perPage);

        return $dataDb;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function queryProducts($request)
    {
        // TODO: Implement queryProducts() method.
        $select = [
            'products.id', 'products.type', 'products.name', 'products.slug',  'products.short_desc', 'products.description', 'time_period', 'start_at', 'end_at', 'price', 'visibility',
            'products.created_at', 'products.updated_at', 'products.created_by', 'products.updated_by'
        ];

        $dataDb = $this->model::select($select)->with('groups');

        return $dataDb;
    }

    /**
     * @param $request
     * @param $productId
     * @return array
     */
    private function saveProductImages($request, $productId)
    {
        #delete existing file
        $this->destroyImages($productId);

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
    private function destroyImages($productId)
    {
        //Media::where('item_id', $productId)->delete();
        return $this->media->deleteMediaByItemId($productId);

    }

    /**
     * @param $request
     * @param $productId
     * @return array
     */
    private function updateProductImages($request, $productId)
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
