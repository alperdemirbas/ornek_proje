<?php

namespace Rezyon\Applications\Locations\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Rezyon\Applications\Locations\Http\Requests\GetStreetList;
use Rezyon\Locations\Repositories\LocationRepository;

class LocationController extends Controller
{
    public function index(Request $request, LocationRepository $repository)
    {
        $key = md5(json_encode($request->only(['sort', 'filter', 'include'])));
        $query = $repository->query($key);
        return response()->json($query);
    }

    public function streetList(GetStreetList $request, LocationRepository $repository)
    {
        $key = md5(json_encode($request->only(['sort', 'neighborhood_id'])));
        $query = $repository->streetList(
            $request->input('neighborhood_id'),
            $key
        );
        return response()->json($query);

    }
}