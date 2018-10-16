<?php

namespace App\Http\Api;

use App\Http\Requests\Brand\ViewRequest;
use App\Http\Resources\WheelResource;
use App\Http\Resources\Wheels;
use App\Models\Wheel;
use Illuminate\Pagination\LengthAwarePaginator;

class WheelsController extends Controller
{

    /**
     * @param ViewRequest $request
     *
     * @return Wheels
     */
    public function index(ViewRequest $request): Wheels
    {
        $resource = Wheel::query()
            ->withCount('likes', 'favorites')
            ->with('image')
            ->paginate();

        return new Wheels($resource);
    }

    /**
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
