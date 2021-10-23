<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyRequest;
use Illuminate\Http\JsonResponse;

class CompanyController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $companies = auth()->user()->companies;

        return response()->json($companies);
    }

    /**
     * @param StoreCompanyRequest $request
     * @return JsonResponse
     */
    public function store(StoreCompanyRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $company = auth()->user()->companies()->create($validated);

        return response()->json($company, 201);
    }
}
