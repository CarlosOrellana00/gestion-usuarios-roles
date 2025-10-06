<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Arr;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller
{
    public function index()
    {
        return JsonResource::collection(
            User::with(['roles', 'permissions'])->paginate(15)
        );
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        if (!empty($data['roles']))       $user->syncRoles($data['roles']);
        if (!empty($data['permissions'])) $user->syncPermissions($data['permissions']);

        return response()->json([
            'message' => 'User created',
            'data'    => [
                'id'          => $user->id,
                'name'        => $user->name,
                'email'       => $user->email,
                'roles'       => $user->getRoleNames(),
                'permissions' => $user->getPermissionNames(),
                'created_at'  => $user->created_at,
            ]
        ], 201);
    }
}
