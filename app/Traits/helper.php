<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename helper.php
 * @LastModified 15/10/2019, 12:43
 */

namespace App\Traits;
use Carbon\Carbon;

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



}
