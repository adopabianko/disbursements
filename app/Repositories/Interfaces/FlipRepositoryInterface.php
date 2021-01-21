<?php

namespace App\Repositories\Interfaces;

interface FlipRepositoryInterface {
    public function disburse($reqData);
    public function checkstatus($reqData);
}
