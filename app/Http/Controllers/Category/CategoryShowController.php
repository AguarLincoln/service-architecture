<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuccessfullResource;
use App\Service\Category\CategoryShowService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CategoryShowController extends Controller
{

    // constructor
    public function __construct(
        private CategoryShowService $service
    )
    {}
    
    /**
     * Handle the incoming request.
     */
    public function __invoke(ShowRequest $request): JsonResponse
    {
        $data = ShowCategoryData::from($request->toArray());
        
        $categories = $this->service->handle($data);

        return response()->json($categories, Response::HTTP_OK);
    }
}
