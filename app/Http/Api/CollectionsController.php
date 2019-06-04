<?php

namespace App\Http\Api;

use App\Http\Requests\Brand\ViewRequest;
use App\Http\Resources\CollectionResource;
use App\Http\Resources\Collections;
use App\Models\Collection;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class CollectionsController
 * @package App\Http\Api
 */
class CollectionsController extends Controller
{

    /**
     * @param ViewRequest $request
     *
     * @return Collections
     */
    public function index(ViewRequest $request): Collections
    {
        return new Collections($this->resource()->paginate());
    }

    /**
     * @param ViewRequest $request
     * @param int $id
     * @return CollectionResource
     */
    public function show(ViewRequest $request, int $id): CollectionResource
    {
        return new CollectionResource(
            $this->queryBuilder()
                ->allowedIncludes('brand')
                ->findOrFail($id)
        );
    }

    /**
     * @return Builder
     */
    protected function query(): Builder
    {
        return Collection::whereEnabled(true);
    }

    /**
     * @return QueryBuilder
     */
    protected function resource(): QueryBuilder
    {
        return $this->queryBuilder()
            ->allowedIncludes('brand')
            ->allowedSorts('name');
    }

}
