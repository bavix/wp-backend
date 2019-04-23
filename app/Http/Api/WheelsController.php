<?php

namespace App\Http\Api;

use App\Http\Requests\Brand\ViewRequest;
use App\Http\Requests\Wheel\FollowRequest;
use App\Http\Requests\Wheel\LikeRequest;
use App\Http\Requests\Wheel\UnfollowRequest;
use App\Http\Resources\WheelResource;
use App\Http\Resources\Wheels;
use App\Models\User;
use App\Models\Wheel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Response;
use Spatie\QueryBuilder\Filter;
use Spatie\QueryBuilder\QueryBuilder;

class WheelsController extends Controller
{

    /**
     * @var string
     */
    protected $defaultSort = '-popular';

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
                ->whereKeyNot($id)
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
     * @param LikeRequest $request
     * @param int $id
     * @return Response
     */
    public function like(LikeRequest $request, int $id): Response
    {
        /**
         * @var $user User
         * @var $wheel Wheel
         */
        $user = $request->user();
        $wheel = $this->query()->findOrFail($id);

        abort_unless($user->like($wheel), 409);

        $result = ['count' => $wheel->likes()->count()];
        return response($result, 201);
    }

    /**
     * @param LikeRequest $request
     * @param int $id
     * @return Response
     */
    public function unlike(LikeRequest $request, int $id): Response
    {
        /**
         * @var $user User
         * @var $wheel Wheel
         */
        $user = $request->user();
        $wheel = $this->query()->findOrFail($id);

        abort_unless($user->unlike($wheel), 409);

        return response()->noContent();
    }

    /**
     * @param FollowRequest $request
     * @param int $id
     * @return Response
     */
    public function favorite(FollowRequest $request, int $id): Response
    {
        /**
         * @var $user User
         * @var $wheel Wheel
         */
        $user = $request->user();
        $wheel = $this->query()->findOrFail($id);

        abort_unless($user->follow($wheel), 409);

        $result = ['count' => $wheel->favorites()->count()];
        return response($result, 201);
    }

    /**
     * @param UnfollowRequest $request
     * @param int $id
     * @return Response
     */
    public function unfavorite(UnfollowRequest $request, int $id): Response
    {
        /**
         * @var $user User
         * @var $wheel Wheel
         */
        $user = $request->user();
        $wheel = $this->query()->findOrFail($id);

        abort_unless($user->unfollow($wheel), 409);

        return response()->noContent();
    }

    /**
     * @return Builder
     */
    protected function query(): Builder
    {
        return Wheel::whereEnabled(true)
            ->when(auth()->user(), function (Builder $query) {
                return $query
                    ->hasFavorited()
                    ->hasLiked();
            });
    }

    /**
     * @return QueryBuilder
     */
    protected function resource(): QueryBuilder
    {
        return $this->queryBuilder()
            ->allowedFilters(
                Filter::exact('brand_id'),
                Filter::exact('collection_id')
            )
            ->allowedIncludes('image', 'brand', 'collection')
            ->allowedSorts('popular', 'name');
    }

}
