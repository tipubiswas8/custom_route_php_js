<?php

namespace App\Http\Api;

use Illuminate\Http\Request;
use App\Models\ModuleLink;
use App\Models\Module;
use Illuminate\Support\Facades\DB;

class ModuleLinkController extends Controller
{
    public function index()
    {
        $modules = Module::where(['active_status' => '1', 'type' => '1'])->orderBy('serial', 'ASC')->get();
        return response()->json($modules);
    }
    public function index2()
    {
        $moduleLink = ModuleLink::where('active_status', 1)->get();
        return view("module.index", ['moduleLink' => $moduleLink]);
    }

    public function create()
    {
        return view("module.create");
    }

    public function store(Request $request)
    {
        $url = $request->url;
        $controller = $request->controller;
        $method  = $request->method;
        $name = $request->name;
        $type  = $request->type;
        $status = $request->status;

        try {
            $insert = ModuleLink::create([
                'url' => $url,
                'controller' => $controller,
                'method' => $method,
                'name' => $name,
                'type' => $type,
                'active_status' => $status
            ]);
            DB::commit();
            return redirect()->back()->with("success", "Module Link Create Successfully!");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with("error", $e . " Something want wrong!, please try again");
        }
    }
}
