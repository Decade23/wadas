<?php

namespace App\Traits\Users;

use App\Models\OpportunitySalesRolling;
use App\Models\Auth\User;

trait SalesRollingOpportunity {

	public function rollingOpportunitySales(){
        $select = [
            'users.id',
            'users.phone'
        ];
        $sales = User::select($select)
                    ->join('role_users','role_users.user_id','users.id')
                    ->join('roles','roles.id','role_users.role_id')
                    ->where('roles.slug','sales') // artinya hanya roles: sales
                    ->whereNotIn('roles.slug',['root']) // exclude roles: root, ... dst. jika ada yang ingin di tambahkan exclude dari rotation
                    ->get()
                    ->toArray();

        $lastRotationId = OpportunitySalesRolling::select('id')->orderBy('id', 'desc')->first();
        $checkRotation  = OpportunitySalesRolling::select('id')->count();
        //return count($sales);
        if ($checkRotation > 0) { // jika sudah di rotation
            
            $rotation = ($lastRotationId->id) % count($sales); // algorithm untuk roll sales
            
            $salesId = $sales[$rotation];

            $waSalesRolling = new OpportunitySalesRolling();
            $waSalesRolling->user_id = $salesId['id'];
            $waSalesRolling->save();

            return $salesId;

        }else{ // jika belum pernah di ratation
            
            $rotation       = 0;
            $salesId        = $sales[$rotation];
            
            $waSalesRolling = new OpportunitySalesRolling();
            $waSalesRolling->user_id = $salesId['id'];

            $waSalesRolling->save();

            return $salesId;

        }

    }

}