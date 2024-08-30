<?php

namespace App\Http\Controllers\ManagementAccess;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ManagementAccess\StoreMenuGroupRequest;
use App\Http\Requests\ManagementAccess\UpdateMenuGroupRequest;
use Spatie\Permission\Models\Permission;
use App\Models\ManagementAccess\MenuGroup;

class MenuGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $menuGroups = MenuGroup::query()
            ->when(! blank($request->search), function ($query) use ($request) {
                return $query
                    ->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('permission_name', 'like', '%' . $request->search . '%');
            })
            ->orderBy('name')
            ->paginate(10);
        $permissions = Permission::orderBy('name')->get();

        return view('management-access.menu-group.index', compact('menuGroups', 'permissions'));
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
    public function store(StoreMenuGroupRequest $request)
    {
        MenuGroup::create(array_merge(
            $request->all(),
            array(
                'status' => ! blank($request->status) ? true : false,
                'position' => MenuGroup::max('position') + 1
            ),
        ));
        alert()->success('success', 'Menu has been created successfully!');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(MenuGroup $menuGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MenuGroup $menuGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuGroupRequest $request, MenuGroup $menuGroup, $id)
    {
        $data = $request->all();
        $data['status'] = ! blank($data['status'] ?? null) ? true : false;
        $findId = $menuGroup->find($id);
        $findId->update($data);

        alert()->success('success', 'Menu has been updated successfully!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $decryptID = decrypt($id);
        $menu = MenuGroup::findOrFail($decryptID);
        $menu->delete();

        alert()->success('Sukses', 'Data berhasil dihapus');
        return back();
    }

    // public function listMenu()
    // {
    //     $menus = MenuGroup::query()
    //         ->with('items', function ($query) {
    //             return $query->where('status', true)->orderBy('position');
    //         })
    //         ->where('status', true)
    //         ->orderBy('position')
    //         ->get();
    //     return view('components.web.menu', compact('menus'));
    // }
}
