<?php

namespace App\Http\Api;

use App\Http\Requests\Brand\ViewRequest;
use App\Http\Resources\BrandResource;
use App\Http\Resources\Brands;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\QueryBuilder;

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
        return new Brands($this->resource()->paginate());
    }

    /**
     * @param ViewRequest $request
     * @param int $id
     * @return BrandResource
     */
    public function show(ViewRequest $request, int $id): BrandResource
    {
        return new BrandResource(
            $this->queryBuilder()
                ->allowedIncludes('image', 'collections')
                ->findOrFail($id)
        );
    }

    /**
     * @return Builder
     */
    protected function query(): Builder
    {
        return Brand::whereEnabled(true);
    }

    /**
     * @return QueryBuilder
     */
    protected function resource(): QueryBuilder
    {
        return $this->queryBuilder()
            ->allowedIncludes('image')
            ->allowedSorts('name');
    }

}
