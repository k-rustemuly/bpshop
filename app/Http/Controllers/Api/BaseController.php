<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Responders\JsonResponder as Responder;
use App\Http\Payloads\SuccessPayload;

class BaseController extends Controller
{
    private $responder;

    public function __construct(Responder $responder)
    {
        $this->responder = $responder;
    }

    public function success($data = null, string $message = null){
        return $this->responder->withResponse(
            new SuccessPayload(
                $data, $message
            )
        )->respond();
    }
}
