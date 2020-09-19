<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename EmailService.php
 * @LastModified 21/07/2020, 03:10
 */

namespace App\Services\Backend\Apl\Email;


use App\Models\Apl\AplEmail;
use App\Models\Auth\Role;
use App\Models\Auth\User;
use App\Models\Media;
use App\Services\Backend\Config\Email\EmailServiceContract;
use App\Services\Backend\Media\MediaServicesContract;
use App\Traits\Email\EmailMailGunTrait;
use App\Traits\Email\EmailSesTrait;
use App\Traits\Email\EmailTrait;
use App\Traits\fileUploadTrait;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class AplEmailService
 * @package App\Services\Backend\Apl\Email
 */
class AplEmailService implements AplEmailServiceContract
{
    use EmailMailGunTrait, fileUploadTrait, EmailSesTrait;
    /**
     * @var AplEmail
     */
    private $model, $productFolder, $configEmail;
    /**
     * AplEmailService constructor.
     */
    public function __construct(AplEmail $aplEmail, MediaServicesContract $mediaServicesContract, EmailServiceContract $emailServiceContract)
    {
        $this->model = $aplEmail;
        $this->productFolder = 'email';
        $this->media = $mediaServicesContract;
        $this->configEmail = $emailServiceContract;
    }

    /**
     * @param int $id
     * @return mixed|void
     */
    public function getById(int $id)
    {
        // TODO: Implement getById() method.
        return $this->model->find($id);
    }

    public function getByAttachmentId(int $id)
    {
        // TODO: Implement getByAttachmentId() method.
        $dataDB = $this->getById($id);
        if ( isset( $dataDB->attachment ) )
        {
            //$file = implode(',', json_decode($dataDB->attachment) );
            return json_decode($dataDB->attachment);
        }
    }


    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse|mixed
     * @throws \Exception
     */
    public function datatable($request)
    {
        // TODO: Implement datatable() method.
        return DataTables::eloquent($this->queryDatatable($request))
            ->addColumn('action', function ($dataDb){
                $btnShow = '';
                $btnEdit = '';
                $btnDelete = '';

                if (Sentinel::inRole('root') || Sentinel::hasAccess(['apl_email.show'])) {
                    $btnShow = '<a href="'.route('apl_email.show', $dataDb->id).'" >
                                <span class="label label-primary label-sm">
                                    <i class="fa fa-arrows-alt"></i>
                                </span>
                                </a>';
                }

                if (Sentinel::inRole('root') || Sentinel::hasAccess(['apl_email.edit'])) {
                    $btnEdit = '<a href="'.route('apl_email.edit', $dataDb->id).'">
                            <i class="flaticon-edit kt-font-brand"></i>
                            </a>
                            ';
                }

                if (Sentinel::inRole('root') || Sentinel::hasAccess(['apl_email.destroy'])) {
                    $btnDelete = '<a href="#"
                                data-message="'.trans('auth.delete_confirmation', ['name' => $dataDb->name]).'"
                                data-href="'.route('apl_email.destroy', $dataDb->id).'"
                                data-method="DELETE"
                                data-toggle="modal"
                                data-target="#delete">
                                <i class="flaticon-delete kt-font-danger"></i>
                    </a>';
                }
                return $btnShow;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function queryDataTable($request)
    {
        // TODO: Implement queryDataTable() method.
        $select = [
            'id', 'from', 'id_mailgun', 'recipient', 'title', 'created_by', 'updated_by', 'created_at', 'updated_at'
        ];

        $dataDb = $this->model::select($select);
        return $dataDb;
    }

    /**
     * @param $request
     * @return int|mixed
     */
    public function select2($request)
    {
        try {
            $perPage    = 10;
            $page       = $request->page ?? 1;

            Paginator::currentPageResolver(function() use($page) {
                return $page;
            });

            $dataDb = $this->model::select(['id', 'title as text'])->where('title', 'LIKE', '%' . $request->term . '%')->orderBy('name')->paginate($perPage);

            return $dataDb;
        } catch (\Exception $exception) {

            // dd($exception->getMessage());
            return $exception->getCode();
        }
    }

    public function tagify($request)
    {
        // TODO: Implement tagify() method.

        try {
            $perPage    = 10;
            $page       = $request->page ?? 1;

            Paginator::currentPageResolver(function() use($page) {
                return $page;
            });

            $dataDb = User::select(['id', 'email', 'name'])
                ->where('email', 'LIKE', '%' . $request->term . '%')
                ->orWhere('name', 'LIKE', '%' . $request->term . '%')
                //->Role('member')
                ->orderBy('id', 'desc')
                ->paginate($perPage);

            return $dataDb;
        } catch (\Exception $exception) {

            // dd($exception->getMessage());
            return $exception->getCode();
        }
    }

    public function tagifyGroup($request)
    {
        // TODO: Implement tagify() method.

        try {
            $perPage    = 10;
            $page       = $request->page ?? 1;

            Paginator::currentPageResolver(function() use($page) {
                return $page;
            });

            $dataDb = Role::select(['id', 'slug', 'name'])
                ->where('name', 'LIKE', '%' . $request->term . '%')
                ->orWhere('slug', 'LIKE', '%' . $request->term . '%')
                //->Role('member')
                ->orderBy('id', 'desc')
                ->paginate($perPage);

            return $dataDb;
        } catch (\Exception $exception) {

            // dd($exception->getMessage());
            return $exception->getCode();
        }
    }

    public function store($request)
    {
        // TODO: Implement store() method.
        DB::beginTransaction();
        try {
            #retrieve User
            $userDB = Sentinel::getUser()->email;

            #get from by id
            $from = $this->configEmail->getById($request->from)->name;

            #convert recipient to array
            $recipient_array = $this->convertRecipientToString($request->recipient);
            $group_array     = $this->convertRecipientToString($request->group);
            $cc_array        = $this->convertRecipientToString($request->cc);
            $bcc_array       = $this->convertRecipientToString($request->bcc);

            //$attachment_email = $this->getAttachmentFile($request->document);
            //dd( $request->all() );
            //dd( var_dump(  $recipient_array) );

            #Store Email
            $emailDB = $this->model;
            $emailDB->from      = $from;
            $emailDB->recipient = $recipient_array;
            $emailDB->group     = $group_array;
            $emailDB->cc        = $cc_array;
            $emailDB->bcc       = $bcc_array;
            $emailDB->title      = $request->subject;
            $emailDB->body      = $request->body_email;
            $emailDB->attachment      = json_encode( $request->document );
            $emailDB->created_by = $userDB;
            $emailDB->updated_by = $userDB;

            $emailDB->save();

            # insert file attachment
            if ( is_array( $request->document ) ) {
                foreach ( $request->document as $file_name ) {
                    $path   = 'public/'. $this->uploadPath .'/'. $this->productFolder . '/'. $file_name;
                    $url    = Storage::disk('s3')->url($path);
                    $files[] = [
                        'type'  => 'attachment_email',
                        'model' => 'AplEmail',
                        'url'   => $url,
                        'path'  => $path,
                        'file_name' => $file_name
                    ];
                }
                $attach = $this->saveFileAttachment($files, $emailDB->id);
            }

            #send Email
            $this->send_email_ses($emailDB);
            #$sendMail = $this->send_email($emailDB);

            DB::commit();

            return $emailDB;

        } catch (\Exception $exception) {
            DB::rollBack();

            dd($exception);
            dd($exception->getMessage() . ' ' . $exception->getLine()  . ' ' . $exception->getCode());
            return $exception->getCode();
        }
    }

    private function saveFileAttachment($request, $productId)
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

    private function destroyImages($productId)
    {
        //Media::where('item_id', $productId)->delete();
        return $this->media->deleteMediaByItemId($productId);

    }
}
