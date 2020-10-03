<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename MainService.php
 * @LastModified 25/03/2020, 00:08
 */

namespace App\Services\Main;


use App\Services\Backend\Fulfillments\Posts\PostsServiceContract;
use App\Services\Frontend\Fulfillments\Posts\PostsFrontEndServiceContract;

/**
 * Class MainService
 * @package App\Services\Main
 */
class MainService implements MainServiceContract
{
    private $serviceBlog;
    /**
     * MainService constructor.
     */
    public function __construct(PostsFrontEndServiceContract $postsFrontEndServiceContract)
    {
        $this->serviceBlog = $postsFrontEndServiceContract;
    }

    public function news()
    {
        // TODO: Implement news() method.
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.covid19api.com/summary",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            $data = collect(['status' => 'error','message' => $err]);
            return [];
            //return $data;
            // return response()->json(['status' => 'error','message' => $err]);
        } else {
            if (json_decode($response) != null) {
                $data = collect(json_decode($response));
                //$data = collect($data['Countries'])->where('CountryCode','ID')->values();
                $data = collect(collect($data['Countries'])->where('CountryCode','ID')->values()[0])->toArray();
                //dd($data);
                return $data;
//                return response()->json(['status' => '200','message' => 'success', 'data' => $response]);
            }
            $data = collect(['status' => '503','message' => 'result null']);
            return [];
            //            return $data->get('status');
            // return response()->json(['status' => '503','message' => 'result null']);
        }
    }

    /**
     * @param $request
     */
    public function anyData($request)
    {
        // TODO: Implement anyData() method.
    }

    public function blog()
    {
        // TODO: Implement blog() method.
        #return $postsFrontEndServiceContract->get();
        return $this->serviceBlog->get();
    }


}
