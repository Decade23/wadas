<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename MemberServices.php
 * @LastModified 20/06/2020, 01:53
 */

namespace App\Services\Backend\Member;


use App\Models\Auth\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class MemberServices implements MemberServicesContract
{
    private $model;
    /**
     * MemberServices constructor.
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function select2Email($request)
    {
        try {
            $perPage = 10;
            $page    = $request->page ?? 1;

            Paginator::currentPageResolver(
                function () use ($page) {
                    return $page;
                }
            );

            $dataDb = $this->model::select('id', DB::raw('email as text'), 'name', 'phone')
                ->with(['address' => function ($query){
                    $query->with('subdistrict');
                }])
                ->where('type', 'customer')
                ->where('email', 'LIKE', '%'.$request->term.'%')
                ->orderBy('email')->paginate($perPage);

            return $dataDb;

        } catch (\Exception $exception) {

            // dd($exception->getMessage());
            return $exception;
        }
    }
}
