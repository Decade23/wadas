<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename MapServices.php
 * @LastModified 20/06/2020, 01:42
 */

namespace App\Services\Backend\Map;


use App\Models\Province;
use App\Models\Subdistricts;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

/**
 * Class MapServices
 * @package App\Services\Backend\Map
 */
class MapServices implements MapServicesContract
{
    /**
     * @param $request
     * @return int|mixed
     */
    public function select2provinces($request)
    {
        // TODO: Implement select2provinces() method.
        try {
            $perPage    = 10;
            $page       = $request->page ?? 1;

            Paginator::currentPageResolver(function() use($page) {
                return $page;
            });

            $dataDb = Province::select(['code as id', 'name as text'])->where('name', 'LIKE', '%' . $request->term . '%')->orderBy('name')->paginate($perPage);

            return $dataDb;
        } catch (\Exception $exception) {

            // dd($exception->getMessage());
            return $exception->getCode();
        }

    }

    /**
     * @param $request
     * @return int|mixed
     */
    public function select2subdistrict($request)
    {
        // TODO: Implement select2subdistrict() method.
        try {
            $perPage    = 10;
            $page       = $request->page ?? 1;

            Paginator::currentPageResolver(function() use($page) {
                return $page;
            });

            $dataDb = Subdistricts::select('id', DB::raw('CONCAT(urban, ", " ,sub_district,", ",city) as text'), 'urban', 'province_code','postal_code','city', 'rajaongkir_city_id')->with('province')->where('city', 'LIKE', '%'.$request->term.'%')->orWhere('sub_district', 'LIKE', '%'.$request->term.'%')->orWhere('urban', 'LIKE', '%'.$request->term.'%')->orderBy('text')->paginate($perPage);

            return $dataDb;
        } catch (\Exception $exception) {

            // dd($exception->getMessage());
            return $exception->getCode();
        }

    }

}
