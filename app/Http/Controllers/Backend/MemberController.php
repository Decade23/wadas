<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Backend\Member\MemberServicesContract;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    private $service;
    /**
     * MemberController constructor.
     */
    public function __construct(MemberServicesContract $memberServicesContract)
    {
        $this->service = $memberServicesContract;
    }

    public function  select2Email(Request $request)
    {
        if ($request->ajax())
        {
            return $this->service->select2Email($request);
        }
        abort('404', 'Uups');
    }
}
