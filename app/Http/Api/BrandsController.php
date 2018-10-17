<?php

namespace App\Http\Api;

use App\Http\Requests\Brand\ViewRequest;
use App\Http\Resources\BrandResource;
use App\Http\Resources\Brands;
use App\Models\Brand;

/**
 * Class BrandsController
 * @package App\Http\Api
 */
class BrandsController extends Controller
{

    /**
     * @param ViewRequest $request
     *
     * @return Brands
     */
    public function index(ViewRequest $request): Brands
    {
        $resource = Brand::query()
            ->withCount('likes', 'favorites')
            ->with('image')
            ->where('enabled', true)
            ->paginate();

        return new Brands($resource);
    }

    /**
     * @param ViewRequest $request
     * @param int $id
     * @return BrandResource
     */
    public function show(ViewRequest $request, int $id): BrandResource
    {
        return new BrandResource(Brand::findOrFail($id));
    }

}
