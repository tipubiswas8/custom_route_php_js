<?php

namespace App\Http\Api;

use App\Models\User;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $users = User::all();
        dd($users);
        return view('test', ['users' => $users]);
    }
}
