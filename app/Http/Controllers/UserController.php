<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return User::select('id','name','email','created_at')
            ->orderByDesc('id')
            ->paginate(10);
    }
}
