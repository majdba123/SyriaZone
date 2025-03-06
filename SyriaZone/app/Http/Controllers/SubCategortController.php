<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubCategory\StoreSubCategoryRequest;
use App\Http\Requests\SubCategory\UpdateSubCategoryRequest;
use App\Services\SubCategory\SubCategoryService;
use Illuminate\Http\JsonResponse;

class SubCategortController extends Controller
{
    protected $subcategoryService;

    public function __construct(SubCategoryService $subcategoryService)
    {
        $this->subcategoryService = $subcategoryService;
    }

    public function index(): JsonResponse
    {
        $categories = $this->subcategoryService->getAll();
        return response()->json($categories);
    }

    public function show($id): JsonResponse
    {
        $category = $this->subcategoryService->getById($id);
        return response()->json($category);
    }

    public function store(StoreSubCategoryRequest $request): JsonResponse
    {
        $category = $this->subcategoryService->store($request->validated());
        return response()->json(['message' => 'Subcategory created successfully.', 'data' => $category], 201);
    }

    public function update(UpdateSubCategoryRequest $request, $id): JsonResponse
    {
        $category = $this->subcategoryService->getById($id);
        $updatedCategory = $this->subcategoryService->update($category, $request->validated());
        return response()->json(['message' => 'Subcategory updated successfully.', 'data' => $updatedCategory]);
    }

    public function destroy($id): JsonResponse
    {
        $category = $this->subcategoryService->getById($id);
        $this->subcategoryService->delete($category);
        return response()->json(['message' => 'Subcategory deleted successfully.']);
    }
}
