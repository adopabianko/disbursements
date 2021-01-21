<?php

namespace App\Repositories;

use App\Repositories\Interfaces\FlipRepositoryInterface;

class FlipRepository implements FlipRepositoryInterface {

    public function disburse($reqData) {
        $secret_key = env('FLIP_API_KEY');
        $encoded_auth = base64_encode($secret_key.":");

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, env('FLIP_URL').'/disburse');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        $payloads = [
            "bank_code" => $reqData->bank_code,
            "account_number" => $reqData->account_number,
            "amount" => $reqData->amount,
            "remark" => $reqData->remark,
        ];

        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payloads));

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/x-www-form-urlencoded"
        ));

        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Basic ".$encoded_auth]);

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response);
    }

    public function checkstatus($reqData)
    {
        $secret_key = env('FLIP_API_KEY');
        $encoded_auth = base64_encode($secret_key.":");

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, env('FLIP_URL')."/disburse/".$reqData->id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/x-www-form-urlencoded"
        ));

        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Basic ".$encoded_auth]);

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response);
    }
}
