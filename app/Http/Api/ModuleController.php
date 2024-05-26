<?php

namespace App\Http\Api;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\ModuleLink;
use Illuminate\Support\Facades\DB;

class ModuleController extends Controller
{
    public function index()
    {
        $modules = Module::where('active_status', 1)->orderBy('serial', 'ASC')->get();
        return response()->json($modules);
    }

    public function create()
    {
        $mainModules = Module::where(['active_status' => '1', 'type' => '1'])->get();
        return view("security_and_access.create", ['mainModules' => $mainModules]);
    }

    public function store(Request $request)
    {
        $name = $request->name;
        $serial = $request->serial;
        $parent_menu_id  = $request->parent_menu_id;
        $status = $request->status;

        try {
            $insert = Module::create([
                'name' => $name,
                'type' => '1',
                'serial' => $serial,
                'parent_menu_id' => '',
                'active_status' => $status
            ]);
            DB::commit();
            $message = [
                'status' => "success",
                'message' => "Module Create Successfully!",
                'code' => 200
            ];
            return response()->json($message);
        } catch (\Exception $e) {
            DB::rollBack();
            $err = [
                'status' => "failed",
                'message' => "Something want wrong!, please try again",
                'code' => 300,
                'error' => $e
            ];
            return response()->json($err);
        }
    }
    public function mainMenu()
    {
        $mainMenu = Module::where(['active_status' => '1', 'type' => '2'])->orderBy('serial', 'ASC')->get();
        return response()->json($mainMenu);
    }
    public function subMenu()
    {
        $mainMenu = Module::where(['active_status' => '1', 'type' => '2'])->orderBy('serial', 'ASC')->get();
        foreach ($mainMenu as $mm) {
            $subMenu = Module::where(['active_status' => '1', 'type' => '3', 'parent_menu_id' => $mm->id])->orderBy('serial', 'ASC')->get();
        }
        return response()->json($subMenu);
    }

    public function path($id)
    {
        $mmRoutes = array();
        $mainMenuRoute = [];
        $subMenuRoute  = [];
        $smRoutes = [];
        $module = Module::where(['active_status' => '1', 'type' => '1', 'link_id' => $id])->first();
        $moduleRoute = ModuleLink::select(['url', 'name'])->where(['module_id' => $module->id, 'main_menu_id' => null])->first();
        $mainMenus = Module::where(['active_status' => '1', 'type' => '2', 'parent_module_id' => $module->id])->orderBy('serial', 'ASC')->get();
        foreach ($mainMenus as $mm) {
            $subMenus = Module::where(['active_status' => '1', 'type' => '3', 'parent_module_id' => $mm->parent_module_id, 'parent_menu_id' => $mm->id])->orderBy('serial', 'ASC')->get();
            $mainMenuRoute = ModuleLink::where(['module_id' => $module->id, 'main_menu_id' => $mm->id, 'sub_menu_id' => null])->get();
            foreach ($subMenus as $subMenu) {
                $subMenuRoute[] = ModuleLink::where(['module_id' => $module->id, 'main_menu_id' => $mm->id, 'sub_menu_id' => $subMenu->id])->get();
                $sMenus[] = $subMenu;
            }
            foreach ($mainMenuRoute as $row) {
                $mmRoutes[] = $row;
            }
        }

        foreach ($subMenuRoute as $row) {
            $smRoutes[] = $row;
        }

        foreach ($mmRoutes as $key => $value) {
            if ($value->main_menu_id == $mainMenus[$key]->id) {
                $mmRoute[] = $value;
            }
        }

        foreach ($smRoutes as $key => $values) {
            foreach ($values as $key => $value) {
                $smRoute[] = $value;
            }
        }

        $data = [
            'module' => $module,
            'mainMenus' => $mainMenus,
            'sMenus' => $sMenus ?? [],
            'moduleRoute' => $moduleRoute ?? [],
            'mmRoute' => $mmRoute ?? [],
            'smRoute' => $smRoute ?? []
        ];
        return response()->json($data);
    }
}
