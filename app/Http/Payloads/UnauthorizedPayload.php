<?php
namespace App\Http\Payloads;

class UnauthorizedPayload extends Payload
{
    protected $status = 401;
    protected $data = ['message' => 'Вы не авторизованы'];
}
