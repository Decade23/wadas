<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename GroupServices.php
 * @LastModified 01/06/2020, 14:28
 */

namespace App\Services\Backend\Groups;


use App\Models\Groups;
use Illuminate\Pagination\Paginator;

/**
 * Class GroupServices
 * @package App\Services\Backend\Groups
 */
class GroupServices implements GroupServicesContract
{
    /**
     * @var Groups
     */
    private $model;

    /**
     * GroupServices constructor.
     */
    public function __construct(Groups $groups)
    {
        $this->model = $groups;
    }

    /**
     * @param $request
     * @param $type
     */
    public function datatableByType($request, $type)
    {
        // TODO: Implement datatableByType() method.
    }

    /**
     * @param $type
     * @return mixed
     */
    public function getGroupByType($type)
    {
        // TODO: Implement getGroupByType() method.
        $select = [
            'groups.id', 'groups.name', 'type', 'created_by', 'created_at','updated_at'
        ];

        return $this->model::select($select)->where('type', $type);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getGroupById(int $id)
    {
        // TODO: Implement getGroupById() method.
        return $this->model::find($id);
    }

    public function destroyGroupById(int $id)
    {
        // TODO: Implement destroyGroupById() method.
        return $this->model::find($id)->delete();
    }

    public function select2ByType($request, $type)
    {
        // TODO: Implement select2ByType() method.
        $perPage    = 10;
        $page       = $request->page ?? 1;

        Paginator::currentPageResolver(function() use($page) {
            return $page;
        });

        $dataDb = $this->model::select(['id', 'name as text'])->where('name', 'LIKE', '%' . $request->term . '%')->orWhere('type', $type)->orderBy('name')->paginate($perPage);

        return $dataDb;
    }
}
