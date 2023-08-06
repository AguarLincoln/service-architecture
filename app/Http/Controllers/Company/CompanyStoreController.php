<?php

namespace App\Http\Controllers\Company;

use App\Data\Company\StoreCompanyData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Company\StoreRequest;
use App\Http\Resources\ErroJsonResource;
use App\Http\Resources\ErroResource;
use App\Http\Resources\SuccessfullResource;
use App\Http\Resources\SuccessfulResource;
use App\Service\Company\CompanyStoreService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class CompanyStoreController extends Controller
{

    //constructor
    public function __construct(
        private CompanyStoreService $companyService,
    ){}
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request)
    {
        $companyData = StoreCompanyData::from($request->toArray());

        $created = $this->companyService->handle($companyData);

        if(!$created){
            return response()->json(
                ErroResource::make('Erro ao criar empresa'),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
        
        return response()->json(
            SuccessfullResource::make(
                message: 'Empresa criada com sucesso',
                data: []
            ), Response::HTTP_CREATED
        );

    }
}
