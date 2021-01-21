<?php

namespace App\Repositories\Interfaces;

interface DisbursementRepositoryInterface {
    public function save($disbursementData);
    public function idExists($id);
    public function findById($id);
    public function updateStatus($reqData, $disbursementData);
    public function datatables();
}
