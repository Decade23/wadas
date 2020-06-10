<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename MediaServices.php
 * @LastModified 03/06/2020, 01:09
 */

namespace App\Services\Backend\Media;


use App\Models\Media;
use App\Traits\fileUploadTrait;
use Illuminate\Support\Facades\Storage;

class MediaServices implements MediaServicesContract
{
    use fileUploadTrait;

    /**
     * MediaServices constructor.
     */
    public function __construct()
    {
    }

    public function storeMedia($request, $folderName = 'media', $deleteUrl = '')
    {
        // TODO: Implement storeMedia() method.
        $this->rule = 'image|max:10000';
        $this->folderName = $folderName;
        $this->deleteUrl = $deleteUrl;


        if (is_array($request->file)) {
            $imageArr = array();
            foreach ($request->file as $index => $file) {
                $imageArr[] = $this->saveFiles($file);
            }
            return $imageArr;
        }
        return $this->saveFiles($request->file);
//        return response()->json([
//            'path' => $this->saveFiles($request->file),
//            'fileName' => $request->file->getClientOriginalName()
//        ]);
    }

    public function deleteMedia($imageUrl, $item_id)
    {
        // TODO: Implement deleteMedia() method.
        #destroy media from provider
    }

    public function deleteMediaByItemId($item_id)
    {
        // TODO: Implement deleteMediaByItemId() method.
        #retrieve media
        $media = Media::where('item_id', $item_id);

        #delete file
        foreach ($media->get() as $file) {
            if (Storage::disk('s3')->exists($file->path)) {
                Storage::disk('s3')->delete($file->path);
            }
        }

        #delete data db
        return $media->delete();
    }


    public function retrieveUploadFiles($request, $folder)
    {
        // TODO: Implement retrieveUploadFiles() method.

        #if data is array
        if  (is_array($request->fileNames)) {
            #if have data exist
            if (count($request->fileNames) > 0) {
                $path = 'public/'. $this->uploadPath. '/' .$folder. '/';
                $html = '<label>Uploaded<span style="color: red">*</span></label><div class="dropzone dropzone-default dropzone-brand" id="doc">';
                foreach ($request->fileNames as $file) {

                    #if file exist
                    if (Storage::disk('s3')->exists($path . $file)) {
                        $img_url = Storage::disk('s3')->url($path . $file);
                        $size = Self::bytesToHuman(Storage::disk('s3')->size($path . $file));

                        $html .= "<div class=\"dz-preview dz-processing dz-image-preview dz-complete\">
                                    <div class=\"dz-image\"><img data-dz-thumbnail=\"\" alt=\"" . $file . "\" src=\"".$img_url."\"></div>
                                    <div class=\"dz-details\">
                                        <div class=\"dz-size\"><span data-dz-size=\"\"><strong>$size</strong></span></div>
                                        <div class=\"dz-filename\"><span data-dz-name=\"\">" . $file . "</span></div>
                                    </div>
                                    <div class=\"dz-progress\"><span class=\"dz-upload\" data-dz-uploadprogress=\"\" style=\"width: 100%;\"></span></div>
                                    <div class=\"dz-error-message\"><span data-dz-errormessage=\"\"></span></div>
                                    <div class=\"dz-success-mark\">
                                        <svg width=\"54px\" height=\"54px\" viewBox=\"0 0 54 54\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\">
                                            <title>Check</title>
                                            <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">
                                                <path d=\"M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z\" stroke-opacity=\"0.198794158\" stroke=\"#747474\" fill-opacity=\"0.816519475\" fill=\"#FFFFFF\"></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class=\"dz-error-mark\">
                                        <svg width=\"54px\" height=\"54px\" viewBox=\"0 0 54 54\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\">
                                            <title>Error</title>
                                            <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">
                                                <g stroke=\"#747474\" stroke-opacity=\"0.198794158\" fill=\"#FFFFFF\" fill-opacity=\"0.816519475\">
                                                    <path d=\"M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z\"></path>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <a class=\"dz-remove remove_image\" id=\"" . $file . "\" href=\"javascript:undefined;\" data-dz-remove=\"\">Remove file</a>
                                </div>";
                    } else { #if file doesn't exist
                        return '';
                    }

                }
                $html .= '</div>';
                return $html;
            }
            #if doesn't have data
            return '';
        }
        #if doesn't have data
        return '';
    }

    public function deleteMediaFromProvider($file, $folder)
    {
        // TODO: Implement deleteMediaFromProvider() method.
        $path = 'public/'. $this->uploadPath. '/' .$folder. '/'. $file;
        return Storage::disk('s3')->delete($path);
    }

    public static function bytesToHuman($bytes)
    {
        // TODO: Implement bytesToHuman() method.
        $units = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];

    }
}
