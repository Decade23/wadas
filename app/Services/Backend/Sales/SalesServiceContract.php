<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename SalesServiceContract.php
 * @LastModified 17/06/2020, 00:48
 */

namespace App\Services\Backend\Sales;


interface SalesServiceContract
{
    public function get(int $id);

    public function store($request);

    public function update(int $id, $request);

    public function datatable($request);

    public function select2($request);

    public function seller_select2($request);

    public function destroyBulk(array $id);

    public function destroy(int $id);

    public function pdf($id);

    public function invoice($id);
}
