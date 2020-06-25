<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename MapController.php
 * @LastModified 20/06/2020, 01:37
 */

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Backend\Map\MapServicesContract;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function __construct(MapServicesContract $mapServicesContract)
    {
        $this->service = $mapServicesContract;
        $this->module = 'backend.map.';
        $this->pageTitle = 'Map';
    }

    public function select2provinces(Request $request)
    {
        if ($request->ajax()) {
            return $this->service->select2provinces($request);
        }

        abort('404', 'Uups');

    }

    public function select2subdistrict(Request $request)
    {
        if ($request->ajax()) {
            return $this->service->select2subdistrict($request);
        }

        abort('404', 'Uups');

    }
}
