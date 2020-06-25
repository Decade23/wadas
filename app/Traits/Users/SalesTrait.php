<?php
/**
 * Created By Fachruzi Ramadhan
 *
 * @Filename     SalesTrait.php
 * @LastModified 4/11/19 11:35 AM.
 *
 * Copyright (c) 2019. All rights reserved.
 */

namespace App\Traits\Users;

use App\Models\Auth\User;
use App\Models\Orders;

trait SalesTrait
{

    /**
     * Roll A Sales
     *
     * @param      $productSales
     *
     * @param null $userId
     *
     * @return mixed
     */
    public function rollSales($productSales, $userId = null)
    {

        $lastOrderId = Orders::select('id')->orderBy('id', 'desc')->first();

        if ($userId == null) {
            if ($productSales->isEmpty()) {

                #Get users
                $user = User::join('role_users','users.id','=','role_users.user_id')->select('users.id')->where('type','user')->where('role_id',2)->get()->toArray();

                if($lastOrderId == false){
                    $lastOrderId = 0;
                }
                else{
                    $lastOrderId = $lastOrderId->id;
                }

                $rotation = ($lastOrderId + 1) % count($user);

                $salesId = $user[$rotation]["id"];

            } else {

                #Agent Users
                $user = $productSales->toArray();

                if($lastOrderId == false){
                    $lastOrderId = 0;
                }
                else{
                    $lastOrderId = $lastOrderId->id;
                }

                $rotation = ($lastOrderId + 1) % count($user);

                $salesId = $user[$rotation]["user_id"];

            }
        } else {
            $salesId = $userId;
        }


        return $salesId;

    }
}