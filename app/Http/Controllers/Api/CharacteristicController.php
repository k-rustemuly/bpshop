<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CharacteristicAddRequest;
use App\Http\Requests\Api\CharacteristicDeleteRequest;
use App\Models\Characteristic;

class CharacteristicController extends BaseController
{

    public function add(CharacteristicAddRequest $request) {
        $characteristic = Characteristic::create($request->validated());
        return $this->success($characteristic);
    }

    public function delete(CharacteristicDeleteRequest $request) {
        $characteristic = Characteristic::where($request->validated())->delete();
        return $this->success($characteristic);
    }
}
