<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface {
    public function datatables();
    public function save($userData);
    public function getRoleUser($userId);
    public function update($reqParam, $userData);
    public function destroy($id);
    public function profileUpdate($reqParam, $userData);
}