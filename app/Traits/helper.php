<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename helper.php
 * @LastModified 15/10/2019, 12:43
 */

namespace App\Traits;
use Carbon\Carbon;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

trait helper
{

    public function getThreeYearAgoFromNow(): array
    {
        return [ Carbon::now()->year,
                 Carbon::now()->subYears(1)->year,
                 Carbon::now()->subYears(2)->year ];
    }

    public function getAllMonths() : array
    {
        for($m=1; $m<=12; ++$m){
            $months[$m] = strftime('%B', mktime(0, 0, 0, $m, 1));
        }

        return $months;
    }


    public function startWeekNumberInMonth($year, $month)
    {
        $timestamp = mktime(0, 0 , 0, $month, 1, $year);
        $number = idate('W', $timestamp);
        return $number;
    }



    public function getStartAndEndDate($year, $week)
    {
        $dto = new \DateTime();

        $dto->setISODate($year, $week);
        $ret['week_start'] = $dto->format('Y-m-d');
        $dto->modify('+6 days');
        $ret['week_end'] = $dto->format('Y-m-d');
        return $ret;
    }

    public function getUserByRole(array $role)
    {
        if ( is_array( $role ) ) {
            # retrieve user
            $userDB = Sentinel::getUserRepository()->with('roles')->get();

            $tempUser = [];

            #loop group
            foreach ($role as $to) {
                #loop user
                #chunk user for reduce memory
                foreach ($userDB as $user) {
                    #loop role
                    foreach ($user->roles as $role) {
                        #save user by group into array/object
                        if ($role->slug == $to)

                            #insert into array/object
                            $tempUser[] = [
                                'email' => $user->email,
                                'role' => $role->slug
                            ];
                    }
                }
            }

            return collect( json_decode(json_encode($tempUser)) );
            #return collect($tempUser);
        }
    }

    public function getUserByRoleChunk(array $role)
    {
        if ( is_array( $role ) ) {
            # retrieve user
            $userDB = Sentinel::getUserRepository()->with('roles')->get()->chunk(100);

            $tempUser = [];

            #loop group
            foreach ($role as $to) {
                #loop user
                #chunk user for reduce memory
                foreach ($userDB as $user) {
                    #loop chunk
                    foreach ( $user as $userChunk )
                    {
                        #loop role
                        foreach ($userChunk->roles as $role) {
                            #save user by group into array/object
                            if ( $userChunk->activations->isNotEmpty() )
                            {
                                #only user active
                                if ( $userChunk->activations[0]->completed == 1 )
                                {
                                    if ($role->slug == $to)
                                    {
                                        #insert into array/object
                                        $tempUser[] = [
                                            'email' => $userChunk->email,
                                            'role' => $role->slug
                                        ];
                                    }
                                }
                            }
                        }
                    }

                }
            }
            return collect( json_decode(json_encode($tempUser)) );
            #return collect($tempUser);
        }
    }

}
