<?php

namespace App\Http\Controllers\API;

use App\Models\Ingredient;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Ingredients\IngredientResource;
use App\Http\Requests\Ingredients\StoreIngredientRequest;
use App\Http\Requests\Ingredients\UpdateIngredientRequest;
use Illuminate\Http\Resources\Json\ResourceCollection;

class IngredientController extends Controller
{ 
    /**
     * Display a listing of the resource.
     */
    public function index(): ResourceCollection
    {
        $ingredients = Ingredient::with('recipes')->get();

        return IngredientResource::collection($ingredients);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIngredientRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $ingredient = Ingredient::create($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Ingredient successfully created',
            'data'    => new IngredientResource($ingredient),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ingredient $ingredient): IngredientResource
    {
        return new IngredientResource($ingredient->load('recipes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIngredientRequest $request, Ingredient $ingredient): JsonResponse
    {
        $validated = $request->validated();

        $ingredient->update($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'ingredient successfully updated',
            'data'    => new IngredientResource($ingredient),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ingredient $ingredient): JsonResponse
    {
        $ingredient->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Ingredient successfully deleted',
        ]);
    }
}
