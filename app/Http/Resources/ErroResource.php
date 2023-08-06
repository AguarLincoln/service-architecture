<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ErroResource extends JsonResource
{
    
    public function __construct(
        private string $message = 'Ocorreu um erro, tente novamente mais tarde.',
    ){}

    public function toArray(Request $request): array
    {
        return [
            'message' => $this->message,
        ];
    }

}
