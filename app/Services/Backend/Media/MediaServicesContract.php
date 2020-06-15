<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename MediaServicesContract.php
 * @LastModified 10/06/2020, 04:01
 */

namespace App\Services\Backend\Media;


/**
 * Interface MediaServicesContract
 * @package App\Services\Backend\Media
 */
interface MediaServicesContract
{
    /**
     * @param $request
     * @param string $folderName
     * @param string $deleteUrl
     * @return mixed
     */
    public function storeMedia($request, $folderName = 'uploads/', $deleteUrl = '');

    /**
     * @param $imageUrl
     * @param $item_id
     * @return mixed
     */
    public function deleteMedia($imageUrl, $item_id);

    /**
     * @param $item_id
     * @return mixed
     */
    public function deleteMediaByItemId($item_id);

    /**
     * @param $request
     * @param $folder
     * @return mixed
     */
    public function retrieveUploadFiles($request, $folder);

    public function retrieveUploadCreateFiles($request, $folder);

    /**
     * @param $bytes
     * @return mixed
     */
    public static function bytesToHuman($bytes);

    /**
     * @param $file
     * @param $folder
     * @return mixed
     */
    public function deleteMediaFromProvider($fileName, $folder);

    public function getMediaByFileName($fileName);

    public function deleteMediaByFileName($fileName);

    public function deleteMediaOnlyDB($fileName);

}
