<?php

namespace App\Http\Api;

use Illuminate\Http\Request;
use App\Models\Module;

class HomeController extends Controller
{
    public function index()
    {
        $modules = Module::where(['active_status' => '1', 'type' => '1'])->orderBy('serial', 'ASC')->get();
        return response()->json($modules);
    }
}
