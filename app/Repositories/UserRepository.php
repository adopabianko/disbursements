<?php

namespace App\Repositories;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\User;
use App\Models\RoleUser;
use Yajra\Datatables\Datatables;

class UserRepository implements UserRepositoryInterface {

    public function datatables() {
        $users =  User::with('role_user.role')->get();

        return Datatables::of($users)
        ->editColumn('actions', function($col) {
            $actions = '';

            if (\Laratrust::isAbleTo('user-edit-data')) {
                $actions .= '
                    <a href="' . route('user.edit', ['user' => $col->id]) . '" class="btn btn-xs bg-gradient-info" data-toggle="tooltip" data-placement="top" title="Edit">
                        <i class="fa fa-pencil-alt" aria-hidden="true"></i>
                    </a>
                ';
            }

            if (\Laratrust::isAbleTo('user-destroy-data') && \Auth::user()->id !== $col->id) {
                $actions .= '
                    <a href="javascript:void(0)" class="btn btn-xs bg-gradient-danger" onclick="Delete('.$col->id.','."'".$col->name."'".')" data-toggle="tooltip" data-placement="top" title="Delete">
                        <i class="fa fa-trash-alt" aria-hidden="true"></i>
                    </a>
                ';
            }

            return $actions;
        })
        ->editColumn('display_name', function($col) {
            return $col->role_user->role->display_name;
        })
        ->rawColumns(['display_name', 'actions'])
        ->addIndexColumn()
        ->make(true);
    }

    public function save($userData) {
        \DB::beginTransaction();

        try {
            $roleId = $userData['role_id'];

            unset($userData['role_id']);
        
            $user = new User($userData);
            $user->password = \Hash::make($userData['password']);

            $user->save();
            $user->attachRole($roleId);

            \DB::commit();

            return true;
        } catch(\Exception $e) {
            \DB::rollback();

            return false;
        }

    }

    public function getRoleUser($userId) {
        return RoleUser::where('user_id', $userId)->first();
    }

    public function update($reqParam, $userData) {
        \DB::beginTransaction();

        try {
            $password = $reqParam->password;
            $updateParam = $reqParam->all();

            if (!empty($password)) {
                $password = \Hash::make($password);

                $updateParam['password'] = $password;
            } else {
                unset($updateParam['password']);
            }

            $roleId = $updateParam['role_id'];

            unset($updateParam['role_id']);
            
            $userData->update($updateParam);

            $userData->syncRoles([$roleId]);

            \DB::commit();
        } catch(\Exception $e) {
            \DB::rollback();

            return false;
        }
    }

    public function destroy($id) {
        return User::where('id', $id)->update(['active' => 0]);
    }

    public function profileUpdate($reqParam, $userData) {
        $reqParam['password'] = \Hash::make($reqParam->password);

        return $userData->update($reqParam->all());
    }
}
