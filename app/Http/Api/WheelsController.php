<?php

namespace App\Http\Api;

use App\Http\Requests\Brand\ViewRequest;
use App\Http\Resources\WheelResource;
use App\Http\Resources\Wheels;
use App\Models\Wheel;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filter;
use Spatie\QueryBuilder\QueryBuilder;

class WheelsController extends Controller
{

    /**
     * @OA\Get(
     *     security={
     *      {
     *          "Bearer": {},
     *          "Client Credentials": {},
     *          "Password": {}
     *      }
     *     },
     *     path="/api/wheels",
     *     tags={"wheels"},
     *     @OA\Response(
     *         response=200,
     *         description="Returns a list of wheels",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Wheel")
     *         )
     *     ),
     * )
     *
     * @param ViewRequest $request
     *
     * @return Wheels
     * @version 0.1
     */
    public function index(ViewRequest $request): Wheels
    {
        return new Wheels($this->resource()->paginate());
    }

    /**
     * @OA\Get(
     *     security={
     *      {
     *          "Bearer": {},
     *          "Client Credentials": {},
     *          "Password": {}
     *      }
     *     },
     *     path="/api/wheels/{id}/similar",
     *     tags={"wheels"},
     *
     *     @OA\Parameter(
     *         name="id",
     *         description="ID of wheels that needs to be fetched",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *           format="int64"
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Returns a list of wheels",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Wheel")
     *         )
     *     ),
     * )
     *
     * @param ViewRequest $request
     * @param int $id
     * @return Wheels
     * @version 0.1
     */
    public function similar(ViewRequest $request, int $id): Wheels
    {
        $wheel = $this->query()->findOrFail($id);

        return new Wheels(
            $this->resource()
                ->where('style_id', $wheel->style_id)
                ->where('id', '!=', $id)
                ->paginate()
        );
    }

    /**
     * @param ViewRequest $request
     * @param int $id
     * @return WheelResource
     */
    public function show(ViewRequest $request, int $id): WheelResource
    {
        return new WheelResource(
            $this->queryBuilder()
                ->allowedIncludes('image', 'images', 'brand')
                ->findOrFail($id)
        );
    }

    /**
     * @return Builder
     */
    protected function query(): Builder
    {
        return Wheel::whereEnabled(true);
    }

    /**
     * @return QueryBuilder
     */
    protected function resource(): QueryBuilder
    {
        return $this->queryBuilder()
            ->allowedFilters(Filter::exact('brand_id'))
            ->allowedIncludes('image', 'brand');
    }

}
