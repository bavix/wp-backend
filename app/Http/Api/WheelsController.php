<?php

namespace App\Http\Api;

use App\Http\Requests\Brand\ViewRequest;
use App\Http\Resources\WheelResource;
use App\Http\Resources\Wheels;
use App\Models\Wheel;

class WheelsController extends Controller
{

    /**
     * @OA\Get(
     *     security={
     *      {"bearer": {}, "password": {}}
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
     */
    public function index(ViewRequest $request): Wheels
    {
        $resource = Wheel::query()
            ->withCount('likes', 'favorites')
            ->with('image')
            ->where('enabled', true)
            ->paginate();

        return new Wheels($resource);
    }

    /**
     * @OA\Get(
     *     security={
     *      {"bearer": {}, "password": {}}
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
     */
    public function similar(ViewRequest $request, int $id): Wheels
    {
        $wheel = Wheel::findOrFail($id);
        $resource = Wheel::query()
            ->withCount('likes', 'favorites')
            ->with('image')
            ->whereNotNull('style_id')
            ->where('style_id', $wheel->style_id)
            ->where('enabled', true)
            ->paginate();

        return new Wheels($resource);
    }

    /**
     * @param ViewRequest $request
     * @param int $id
     * @return WheelResource
     */
    public function show(ViewRequest $request, int $id): WheelResource
    {
        return new WheelResource(Wheel::findOrFail($id));
    }

}
