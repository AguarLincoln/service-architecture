<?php

namespace App\Http\Controllers\Auth\Company;

use App\Data\Auth\LoginData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Company\LoginRequest;
use App\Http\Resources\ErroResource;
use App\Http\Resources\SuccessfullResource;
use App\Service\Auth\LoginService;
use Illuminate\Http\Response;

class CompanyLoginController extends Controller
{
    
    private const GUARD = 'api-company';

    public function __construct(
        private LoginService $companyLoginService,
    ){}
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        $loginData = LoginData::from($request->toArray());

        $response = $this->companyLoginService->handle($request, $loginData, self::GUARD);

        if(!$response){
            return response()->json(
                ErroResource::make('Erro ao fazer login'),
                Response::HTTP_UNAUTHORIZED
            );
        }

        return response()->json(
            SuccessfullResource::make(
                message: 'Login realizado com sucesso',
                data: $response->toArray()
            ), Response::HTTP_OK
        );
    }
}
