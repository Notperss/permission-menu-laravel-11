<?php

namespace App\Http\Controllers\ManagementAccess;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\ManagementAccess\StoreUserRequest;
use App\Http\Requests\ManagementAccess\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::query()
            ->when(! blank($request->search), function ($query) use ($request) {
                return $query
                    ->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            })
            ->with('roles', function ($query) {
                return $query->select('name');
            })
            ->latest()
            ->paginate(10);
        $roles = Role::orderBy('name')->get();

        return view('management-access.user.index', compact('users', 'roles'));
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
    public function store(StoreUserRequest $request)
    {
        // dd($request->all());
        User::create(array_merge(
            $request->all(),
            array(
                'password' => Hash::make('password'),
                'email_verified_at' => ! blank($request->verified) ? now() : null,
            )
        ))?->assignRole(! blank($request->role) ? $request->role : array());

        alert()->success('Success', 'User has been created successfully!');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->syncRoles($request->role);

        $emailExists = User::firstWhere('email', $request->email) !== null;
        $isSameEmail = $request->email === $user->email;

        $email = $isSameEmail || ! $emailExists ? $request->email : null;

        if ($email) {
            $user->update([
                'email' => $email,
                'email_verified_at' => $request->verified ? now() : null,
            ] + $request->except('email'));
        }

        alert()->success('success', 'User has been updated successfully!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        alert()->success('success', 'User has been deleted successfully!');
        return back();
    }
}
