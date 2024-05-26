<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\ModuleLink;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ModuleLinkController extends Controller
{
    public function index()
    {
        $moduleLink = ModuleLink::where('active_status', 1)->get();
        return view("module.index", ['moduleLink' => $moduleLink]);
    }

    public function create()
    {
        $modules = Module::where(['type' => '1'])->get();
        $mainMenu = Module::where(['active_status' => '1', 'type' => '2'])->get();
        $subMenu = Module::where(['active_status' => '1', 'type' => '3'])->get();
        return view("module.create", ['modules' => $modules, 'mainMenu' => $mainMenu, 'subMenu' => $subMenu]);
    }

    public function store(Request $request)
    {
        $module_id  = $request->module_id;
        $module_name = 'Common';
        if($module_id){
            $module_name = Module::select('name')->where('id', $module_id)->first()->name;
        }
        $type  = $request->type;
        $url = $request->url;
        $controller = $module_name."Controller";
        $method  = $request->method;
        $name = Str::replace('/', '-', $url);
        $main_menu_id  = $request->main_menu;
        $sub_menu_id  = $request->sub_menu;
        $status = $request->status;
        
        try {
            $insert = ModuleLink::create([
                'type' => $type,
                'url' => $url,
                'controller' => $controller,
                'method' => $method,
                'name' => $name,
                'module_id' => $module_id,
                'main_menu_id' => $main_menu_id,
                'sub_menu_id' => $sub_menu_id,
                'active_status' => $status
            ]);
            DB::commit();
            return redirect()->back()->with("success", "Module Link Create Successfully!");
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            return redirect()->back()->with("error", $e . " Something want wrong!, please try again");
        }
    }
}
