<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\V1\UpdateFurnitureRequest;
use App\Http\Requests\V1\StoreFurnitureRequest;
use App\Http\Resources\V1\FurnitureCollection;
use App\Http\Resources\V1\FurnitureResource;
use Illuminate\Routing\Controller;
use App\Models\Furniture;
use App\Pipelines\V1\Filters\FurnitureFilter;
use App\Pipelines\V1\Sorters\FurnitureSorter;
use App\Pipelines\PiplineHandler;
use Illuminate\Http\Request;

class FurnitureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return void
     */
    public function index(Request $request)
    {
        $pipeline = new PiplineHandler([
            FurnitureFilter::class,
            FurnitureSorter::class,
        ]);

        $limit = (int) $request->get('limit', 10);

        return new FurnitureCollection($pipeline->apply(Furniture::query())->paginate($limit));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreFurnitureRequest $request
     * @return void
     */
    public function store(StoreFurnitureRequest $request)
    {
        return new FurnitureResource(Furniture::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  FurnitureResource $furniture
     * @return void
     */
    public function show(Furniture $furniture)
    {
        return new FurnitureResource($furniture);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateFurnitureRequest $request
     * @param  Furniture $furniture
     * @return void
     */
    public function update(UpdateFurnitureRequest $request, Furniture $furniture)
    {
        $furniture->update($request->all());

        return new FurnitureResource($furniture);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Furniture $furniture
     * @return void
     */
    public function destroy(Furniture $furniture)
    {
        $furniture->delete();

        return response(null, 204);
    }
}
