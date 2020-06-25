<?php
/**
 * Created By Fachruzi Ramadhan
 *
 * @Filename     ActiveInactive.php
 * @LastModified 2/13/19 3:50 PM.
 *
 * Copyright (c) 2019. All rights reserved.
 */

namespace App\Traits\Users;

use Cartalyst\Sentinel\Laravel\Facades\Activation;

trait ActiveInactive {

    /**
     * To change member status
     *
     * @param $userDb
     * @param $status
     *
     * @return bool
     */
    public function activeInActive($userDb, $status)
    {

        try {

            if ($status == 'inactive') {

                foreach ($userDb->activations as $activation) {
                    #Remove the activation account
                    Activation::remove($userDb);
                }

                return true;

            } else {

                if (Activation::completed($userDb) == false) {

                    #Create Activation
                    $activationCreate = Activation::create($userDb);

                    #Activate this account
                    Activation::complete($userDb, $activationCreate->code);

                    return true;
                }

                return false;
            }

        } catch (\Exception $exception) {

            // dd($exception->getMessage());
            return $exception->getCode();

        }
    }
}
