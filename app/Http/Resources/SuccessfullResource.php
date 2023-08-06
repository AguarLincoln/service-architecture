<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class SuccessfullResource extends JsonResource
{

    public function __construct(
        private ?string $message = null,
        private array $data = [],
    ){}
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $return = [];

        if($this->message){
            $return['message'] = $this->message;
        }

        if(!empty($this->data)){
            $return['data'] = $this->data;
        }

        return $return;
    }
}
