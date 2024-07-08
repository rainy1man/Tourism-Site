<?php

namespace App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class AuthController extends Controller
{
    public function login(Request $request)
    {
        $log = $request->only('email', 'password');

        if (Auth::attempt($log)) {
            $user = Auth::user();
            $token = $user->createToken('token-name')->plainTextToken;
            return response()->json(['token' => $token]);
        }

        return response()->json(['error' => 'Unauthorized']);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
    /**
     * Display a listing of the resource.
     */
    public function role_index()
    {
        $roles = Role::all();
        return response()->json($roles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $role = Role::create(['name' => $request->name]);
        if ($role) {
            return response()->json($role);
        } else {
            return response()->json(['error' => 'Role creation failed']);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $role = Role::findById($id);
        $role->name = $request->name;

        if ($role->save()) {
            return response()->json($role);
        } else {
            return response()->json(['error' => 'Role update failed']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $role = Role::findById($id);
        $role->delete();
        return response()->json(['message' => 'Role deleted successfully']);
    }
    public function update_role_permissions(Request $request, $id)
    {
        $role = Role::findById($id);
        $role->syncPermissions($request->permissions);
        return response()->json(['message' => 'Permissions updated successfully']);
    }


    public function show_user_roles($id)
    {
        $user = User::findById($id);

        return response()->json($user->roles);
    }
    public function update_user_roles(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->syncRoles($request->roles);
        return response()->json(['message' => 'Roles updated successfully']);
    }

    public function show_user_permissions($id)
    {
        $user = User::findOrFail($id);

        return response()->json($user->permissions);
    }

    public function update_user_permissions(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->syncPermissions($request->permissions);
        return response()->json(['message' => 'Permissions updated successfully']);
    }

    public function permission_index()
    {
        $permissions = Permission::all();

        if ($permissions) {
            return response()->json($permissions);
        } else {
            return response()->json(['error' => 'Permissions not found']);
        }
    }

}
