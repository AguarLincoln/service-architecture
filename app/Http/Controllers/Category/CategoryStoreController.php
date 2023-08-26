<?php

namespace App\Http\Controllers\Category;

use App\Data\Category\StoreCategoryData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Resources\ErroResource;
use App\Http\Resources\SuccessfullResource;
use App\Service\Category\CategoryStoreService;
use Illuminate\Http\Response;

class CategoryStoreController extends Controller
{

    // constructor
    public function __construct(
        private CategoryStoreService $service
    )
    {}
    
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request)
    {
        $categoryData = StoreCategoryData::from($request->toArray());
        $save = $this->service->handle($categoryData);

        if(!$save){
            return response()->json(
                ErroResource::make('Erro ao criar categoria'),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        return response()->json(
            SuccessfullResource::make(
                message: 'Categoria criada com sucesso',
                data: []
            ), Response::HTTP_CREATED
        );


    }
}
