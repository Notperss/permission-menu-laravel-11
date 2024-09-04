<?php

namespace App\Http\Controllers\ManagementAccess;

use App\Models\ManagementAccess\MenuItem;
use App\Models\ManagementAccess\MenuGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\ManagementAccess\StoreMenuItemRequest;
use App\Http\Requests\ManagementAccess\UpdateMenuItemRequest;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, MenuGroup $menu)
    {
        // If user is not authorized, abort
        // if (! Gate::allows('menu_item_index')) {
        //     abort(403);
        // }
        $menuItems = $menu->items()
            ->when(! blank($request->search), function ($query) use ($request) {
                return $query
                    ->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('permission_name', 'like', '%' . $request->search . '%');
            })
            ->orderBy('name')
            ->paginate(10);
        $permissions = Permission::orderBy('name')->get();
        $routes = Route::getRoutes();

        return view('management-access.menu-item.index', compact('menu', 'menuItems', 'permissions', 'routes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // If user is not authorized, abort
        // if (! Gate::allows('menu_item_index')) {
        //     abort(403);
        // }
        return view('pages.management-access.menu.item.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuItemRequest $request, MenuGroup $menu)
    {
        MenuItem::create(array_merge(
            $request->all(),
            array(
                'menu_group_id' => $menu->id,
                'status' => ! blank($request->status) ? true : false,
                'position' => $menu->items()->max('position') + 1
            )
        ));
        alert()->success('Success', 'Menu Item has been created successfully!');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(MenuItem $menuItem)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MenuItem $menuItem)
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuItemRequest $request, MenuItem $menuItem, MenuGroup $menu, $id)
    {
        // dd($menu->id, $menuItem, $id);
        $menuItemId = $menuItem->findOrFail($id);
        $menuItemId->update(array_merge(
            $request->all(),
            array(
                'menu_group_id' => $menu->id,
                'status' => ! blank($request->status) ? true : false
            )
        ));

        alert()->success('Success', 'Menu Item has been updated successfully!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MenuGroup $menu, MenuItem $item)
    {
        $item->delete();

        alert()->success('Success', 'Menu Item has been deleted successfully!');
        return back();
    }
}
