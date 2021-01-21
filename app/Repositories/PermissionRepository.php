<?php

namespace App\Repositories;

use App\Repositories\Interfaces\PermissionRepositoryInterface;
use App\Models\Permission;
use Yajra\Datatables\Datatables;

class PermissionRepository implements PermissionRepositoryInterface {

    public function getAll() {
        return Permission::all();
    }

    public function datatables() {
        return Datatables::of(Permission::orderBy('id','desc')->get())
            ->editColumn('actions', function($col) {
                $actions = '';

                if (\Laratrust::isAbleTo('permission-edit-data')) {
                    $actions .= '
                        <a href="'.route('permission.edit', ['permission' => $col->id]).'" class="btn btn-xs bg-gradient-info" data-toggle="tooltip" data-placement="top" title="Edit">
                            <i class="fa fa-pencil-alt" aria-hidden="true"></i>
                        </a>
                    ';
                }

                return $actions;
            })
            ->rawColumns(['actions'])
            ->addIndexColumn()
            ->make(true);
    }

    public function save($permissionData) {
        $permission = new Permission($permissionData);

        return $permission->save();
    }

    public function getById($id) {
        return Permission::findOrFail($id);
    }

    public function update($reqParam, $permissionData) {
        return $permissionData->update($reqParam->all());
    }
}
