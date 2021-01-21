<?php

namespace App\Repositories\Interfaces;

interface RoleRepositoryInterface {
    public function getAll();
    public function datatables();
    public function save($roleData);
    public function getById($id);
    public function update($reqParam, $roleData);
}