<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Responders\JsonResponder as Responder;
use App\Http\Payloads\SuccessPayload;
use App\Http\Payloads\UnauthorizedPayload;

class BaseController extends Controller
{
    protected $responder;

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

    public function unauthorized(string $message = null){
        return $this->responder->withResponse(
            new UnauthorizedPayload($message)
        )->respond();
    }
}
