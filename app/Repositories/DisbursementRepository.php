<?php

namespace App\Repositories;

use App\Repositories\Interfaces\DisbursementRepositoryInterface;
use App\Models\Disbursement;
use Yajra\Datatables\Datatables;

class DisbursementRepository implements DisbursementRepositoryInterface {

    public function save($disbursementData) {
        $disbursement = new Disbursement();
        $disbursement->id = $disbursementData->id;
        $disbursement->amount = $disbursementData->amount;
        $disbursement->status = $disbursementData->status;
        $disbursement->timestamp = $disbursementData->timestamp;
        $disbursement->bank_code = $disbursementData->bank_code;
        $disbursement->account_number = $disbursementData->account_number;
        $disbursement->beneficiary_name = $disbursementData->beneficiary_name;
        $disbursement->remark = $disbursementData->remark;
        $disbursement->receipt = $disbursementData->receipt;
        $disbursement->fee = $disbursementData->fee;

        return $disbursement->save();
    }

    public function idExists($id) {
        return Disbursement::select('id')->where('id', $id)->first();
    }

    public function findById($id) {
        return Disbursement::find($id);
    }

    public function updateStatus($reqData, $disbursementData)
    {
        return Disbursement::where('id', $reqData->id)
            ->update([
                'status' => $disbursementData->status,
                'receipt' => $disbursementData->receipt,
                'time_served' => $disbursementData->time_served,
            ]);
    }

    public function datatables() {
        return Datatables::of(Disbursement::orderBy('created_at','desc')->get())
            ->addIndexColumn()
            ->make(true);
    }
}
