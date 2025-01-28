<?php

namespace App\Http\Controllers\API;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Recipes\RecipeResource;
use App\Http\Requests\Recipes\StoreRecipeRequest;
use App\Http\Requests\Recipes\UpdateRecipeRequest;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): ResourceCollection
    {
        $query = Recipe::query()->with('ingredients');

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->has('ingredient_ids')) {
            $ingredientIds = $request->input('ingredient_ids');
            $query->whereHas('ingredients', function ($q) use ($ingredientIds) {
                $q->whereIn('id', $ingredientIds);
            });
        }

        $recipe = $query->get();

        return RecipeResource::collection($recipe);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRecipeRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $recipe = Recipe::create($validated);

        if ($request->has('ingredient_ids')) {
            $recipe->ingredients()->sync($request->input('ingredient_ids'));
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Recipe successfully created',
            'data'    => new RecipeResource($recipe->load('ingredients')),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe): RecipeResource
    {
        return new RecipeResource($recipe->load('ingredients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRecipeRequest $request, Recipe $recipe): JsonResponse
    {
        $validated = $request->validated();

        $recipe->update($validated);

        if ($request->has('ingredient_ids')) {
            $recipe->ingredients()->sync($request->input('ingredient_ids'));
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Recipe successfully updated',
            'data'    => new RecipeResource($recipe->load('ingredients')),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe): JsonResponse
    {
        $recipe->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Recipe successfully deleted',
        ]);
    }
}
