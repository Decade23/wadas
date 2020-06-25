<?php
/**
 * Created By Fachruzi Ramadhan
 *
 * @Filename     UserProductTrait.php
 * @LastModified 2/13/19 2:39 PM.
 *
 * Copyright (c) 2019. All rights reserved.
 */

namespace App\Traits\Users;

use App\Models\Auth\UserProduct;
use App\Models\Product;
use Carbon\Carbon;

trait UserProductTrait
{
    /**
     * For Save User Product
     *
     * @param $orderDetailDb
     *
     * @return bool
     */
    public function storeUserProduct($orderDetailDb, $trialDays = 0)
    {

        if($orderDetailDb->product_id !== null){
            #This Product Is Already In Our Record?
            $userProductDb = UserProduct::firstOrCreate(['product_id' => $orderDetailDb->product_id, 'user_id' => $orderDetailDb->order->customer_id]);

            $userProductDb->membership_status = null;
            $userProductDb->start_at   = isset($orderDetailDb->product->start_at) ? $orderDetailDb->product->start_at : null;
            $userProductDb->expired_at = isset($orderDetailDb->product->end_at) ? $orderDetailDb->product->end_at : null;

            $userProductDb->save();
            return $userProductDb;
        }
        else{
            return false;
        }
    }

    /**
     * This User Is Expired or Not?
     *
     * @param $expiredAt
     * @param $timePeriod
     *
     * @return string
     */
    public function expiredAt($expiredAt, $timePeriod, $trialDays = 0) #penambahan trialDays jika produk memiliki masa trial/percobaan
    {
        if ($expiredAt == null) {

            #Empty Memberships..
            $expiredAt = now()->addMonth($timePeriod)->addDays($trialDays)->format('Y-m-d');
        } else {

            $differentDays = now()->diffInDays($expiredAt, false);

            if ($differentDays <= 0) {

                # Expired Memberships
                $expiredAt = now()->addMonth($timePeriod)->addDays($trialDays)->format('Y-m-d');
            } else {

                # Extend The Memberships Time
                $expiredAt = Carbon::parse($expiredAt)->addMonth($timePeriod)->addDays($trialDays)->format('Y-m-d');
            }
        }
        // dd($expiredAt);
        return $expiredAt;
    }
}
