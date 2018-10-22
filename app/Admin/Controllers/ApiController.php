<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Collection;
use App\Models\Wheel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

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

}
