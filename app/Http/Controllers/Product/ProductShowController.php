<?php

namespace App\Http\Controllers\Product;

use App\Data\Product\StoreProductData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Resources\ErroResource;
use App\Http\Resources\SuccessfullResource;
use App\Service\Product\ProductShowService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ProductShowController extends Controller
{
    // constructor
    public function __construct(
        private ProductShowService $service
    )
    {}
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $created = $this->service->handle(20);

        if(!$created){
            return response()->json(
                ErroResource::make('Erro ao criar produto'),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
        
        return response()->json(
            SuccessfullResource::make(
                'Produto criado com sucesso',
                []
            ), Response::HTTP_CREATED
        );
        
    }
}
