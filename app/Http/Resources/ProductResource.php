<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Transformers\CharacteristicTransformer;
class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            "id" => $this->id,
            "name" => $this->name,
            "description" => $this->description,
            "slug" => $this->slug,
            "price" => $this->price,
            "category" => $this->category,
            "characteristics" => fractal()->collection($this->characteristics()->get(), new CharacteristicTransformer())->toArray()["data"]
        ];
    }
}
