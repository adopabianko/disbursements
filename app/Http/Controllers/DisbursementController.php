<?php

namespace App\Http\Controllers;

use App\Http\Requests\DisbursementRequest;
use App\Http\Requests\UpdateStatusRequest;
use App\Repositories\DisbursementRepository;
use App\Repositories\FlipRepository;

class DisbursementController extends Controller
{
    private $flipRepository;
    private $disbursementRepository;

    public function __construct(
        FlipRepository $flipRepository,
        DisbursementRepository $disbursementRepository
    ) {
        $this->flipRepository = $flipRepository;
        $this->disbursementRepository = $disbursementRepository;
    }

    public function create() {
        return view('disbursement.create');
    }

    public function checkstatus() {
        return view('disbursement.checkstatus');
    }

    public function updatestatus(UpdateStatusRequest $request) {
        // check disbursement data
        $idExists = $this->disbursementRepository->idExists($request->id);

        if(!$idExists) {
            $responseData = ['status' => 'error', 'message' => 'Disbursement data is not found!'];
            $httpCode = 404;

            return response()->json($responseData, $httpCode);
        }

        try{
            $responseApi = $this->flipRepository->checkstatus($request);

            $this->disbursementRepository->updateStatus($request, $responseApi);

            $disbursementData = $this->disbursementRepository->findById($request->id);

            $responseData = ['status' => 'success', 'data' => $disbursementData];
            $httpCode = 200;
        } catch (\Exception $e) {
            $responseData = ['status' => 'error', 'message' => 'Check status data failed, please try again'];
            $httpCode = 500;
        }

        return response()->json($responseData, $httpCode);
    }

    public function store(DisbursementRequest $request) {
        try {
            $responseAPI = $this->flipRepository->disburse($request);

            $this->disbursementRepository->save($responseAPI);

            $responseData = ['status' => 'success', 'message' => 'Disbursement has been successfully processed'];
            $httpCode = 200;
        } catch (\Exception $e) {
            $responseData = ['status' => 'error', 'message' => 'Disbursement failed in the process, please try again'];
            $httpCode = 500;
        }

        return response()->json($responseData, $httpCode);
    }

    public function list() {
        return view('disbursement.list');
    }

    public function datatables() {
        return $this->disbursementRepository->datatables();
    }
}
