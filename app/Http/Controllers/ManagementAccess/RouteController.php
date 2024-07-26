<?php

namespace App\Http\Controllers\ManagementAccess;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ManagementAccess\Route;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Route as FacadesRoute;
use App\Http\Requests\ManagementAccess\StoreRouteRequest;
use App\Http\Requests\ManagementAccess\UpdateRouteRequest;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $routes = Route::query()
            ->when(! blank($request->search), function ($query) use ($request) {
                return $query
                    ->where('route', 'like', '%' . $request->search . '%')
                    ->orWhere('permission_name', 'like', '%' . $request->search . '%');
            })
            ->orderBy('route')
            ->get();
        $facadesRoutes = FacadesRoute::getRoutes();

        $permissions = Permission::orderBy('name')->get();

        return view('management-access.route.index', compact('routes', 'permissions', 'facadesRoutes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRouteRequest $request)
    {
        Route::create(array_merge(
            $request->all(),
            array('status' => ! blank($request->status) ? true : false)
        ));
        return back()->with('success', 'Route has been created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Route $route)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Route $route)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRouteRequest $request, Route $route)
    {
        $route->update(array_merge(
            $request->all(),
            array('status' => ! blank($request->status) ? true : false)
        ));
        return back()->with('success', 'Route has been created successfully!')
        ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Route $route)
    {
        return $route->delete()
            ? back()->with('success', 'Route has been deleted successfully!')
            : back()->with('failed', 'Route was not deleted successfully!');
    }
}
