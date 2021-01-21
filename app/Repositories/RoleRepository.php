<?php

namespace App\Repositories;

use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Models\Role;
use Yajra\Datatables\Datatables;

class RoleRepository implements RoleRepositoryInterface {

    public function getAll() {
        return Role::all();
    }

    public function datatables() {
        return Datatables::of(Role::orderBy('id','desc')->get())
            ->editColumn('actions', function($col) {
                $actions = '';

                if (\Laratrust::isAbleTo('role-edit-data')) {
                    $actions .= '
                        <a href="'.route('role.edit', ['role' => $col->id]).'" class="btn btn-xs bg-gradient-info" data-toggle="tooltip" data-placement="top" title="Edit">
                            <i class="fa fa-pencil-alt" aria-hidden="true"></i>
                        </a>
                    ';
                }

                if (\Laratrust::isAbleTo('role-access-management')) {
                    $actions .= '
                        <a href="' . route('role.access-management', ['role' => $col->id]) . '" class="btn btn-xs bg-gradient-secondary" data-toggle="tooltip" data-placement="top" title="Access Management">
                            <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                        </a>
                    ';
                }

                return $actions;
            })
            ->rawColumns(['actions'])
            ->addIndexColumn()
            ->make(true);
    }

    public function save($roleData) {
        $role = new Role($roleData);

        return $role->save();
    }

    public function getById($id) {
        return Role::findOrFail($id);
    }

    public function update($reqParam, $roleData) {
        return $roleData->update($reqParam->all());
    }
}
