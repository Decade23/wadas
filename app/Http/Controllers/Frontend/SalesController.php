<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\Backend\Sales\SalesServiceContract;
use Illuminate\Http\Request;

class SalesController extends Controller
{

    public function invoice($id, SalesServiceContract $salesServiceContract)
    {
        return $salesServiceContract->invoice($id);
    }
}
