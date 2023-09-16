<?php

namespace App\Http\Controllers\Product;

use App\Data\Product\StoreProductData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Resources\ErroResource;
use App\Http\Resources\SuccessfullResource;
use App\Service\Product\ProductStoreService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ProductStoreController extends Controller
{
    // constructor
    public function __construct(
        private ProductStoreService $service
    )
    {}
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request, string $category)
    {
        $category = Auth::guard('api-company')->user()->categories()->find($category); // create a service to do this
        
        if(!$category){
            return response()->json(
                ErroResource::make('Categoria não encontrada'),
                Response::HTTP_NOT_FOUND
            );
        }
        
        $productData = StoreProductData::from($request->validated());
        $created = $this->service->handle($productData, $category);

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
