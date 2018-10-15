<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Collection;
use App\Models\Style;
use App\Models\Wheel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{

    /**
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function brands(Request $request): LengthAwarePaginator
    {
        $query = '%' . $request->get('q') . '%';

        return Brand::where('name', 'like', $query)
            ->paginate(null, ['id', 'name as text']);
    }

    /**
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function collections(Request $request): LengthAwarePaginator
    {
        $query = '%' . $request->get('q') . '%';

        return Collection::where('name', 'like', $query)
            ->paginate(null, ['id', 'name as text']);
    }

    /**
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function wheels(Request $request): LengthAwarePaginator
    {
        $query = '%' . $request->get('q') . '%';

        return Wheel::where('name', 'like', $query)
            ->paginate(null, ['id', 'name as text']);
    }

}
