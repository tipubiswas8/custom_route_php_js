<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\ModuleLink;
use Illuminate\Support\Facades\DB;

class ModuleController extends Controller
{
    public function index()
    {
        $modules = Module::where(['active_status' => '1', 'type' => '1'])->orderBy('serial', 'ASC')->get();
        return view("security_and_access.index", ['modules' => $modules]);
    }

    public function menuIndex()
    {
        $menus = Module::where(['active_status' => '1', 'type' => '2'])->orderBy('serial', 'ASC')->get();
        return view("security_and_access.menu", ['menus' => $menus]);
    }

    public function create()
    {
        // $mainMenu = Module::where(['active_status' => '1', 'type' => '2'])->get();
        // return view("security_and_access.create", ['mainMenu' => $mainMenu]);
        return view("home.create");
    }

    public function menuCreate()
    {
        $modules = Module::where(['type' => '1'])->get();
        $mainMenu = Module::where(['active_status' => '1', 'type' => '2'])->get();
        return view("security_and_access.create", ['mainMenu' => $mainMenu, 'modules' => $modules]);
    }

    public function store(Request $request)
    {
        $name = $request->name;
        $type = $request->type;
        $serial = $request->serial;
        $parent_module_id  = $request->id;
        $parent_menu_id  = $request->parent_menu_id;
        $status = $request->status;
        $icon = $request->icon;
        try {
            if ($type == '1') {
                $link_id = Module::max('link_id');
                $link_id = $link_id ? $link_id : 0;
                $insert = Module::create([
                    'name' => $name,
                    'type' => '1',
                    'icon' => $icon,
                    'serial' => $serial,
                    'link_id' => $link_id + 1,
                    'parent_menu_id' => '',
                    'active_status' => $status
                ]);
                DB::commit();
                return redirect()->back()->with("success", "Module Create Successfully!");
            } else {

                $insert = Module::create([
                    'name' => $name,
                    'type' => $type,
                    'serial' => $serial,
                    'parent_module_id' => $parent_module_id,
                    'parent_menu_id' => $parent_menu_id ? $parent_menu_id : '',
                    'active_status' => $status
                ]);
                DB::commit();
                return redirect()->back()->with("success", "Module Create Successfully!");
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with("error", $e . " Something want wrong!, please try again");
        }
    }

    public function path($id)
    {
        $mmRoutes = array();
        $mainMenuRoute = [];
        $subMenuRoute  = [];
        $smRoutes = [];
        $module = Module::where(['active_status' => '1', 'type' => '1', 'link_id' => $id])->first();
        $moduleRoute = ModuleLink::select(['url', 'name'])->where(['link_type' => '1', 'module_id' => $module->id])->first();
        $mainMenus = Module::where(['active_status' => '1', 'type' => '2', 'parent_module_id' => $module->id])->orderBy('serial', 'ASC')->get();
        foreach ($mainMenus as $mm) {
            $subMenus = Module::where(['active_status' => '1', 'type' => '3', 'parent_module_id' => $mm->parent_module_id, 'parent_menu_id' => $mm->id])->orderBy('serial', 'ASC')->get();
            $mainMenuRoute = ModuleLink::where(['link_type' => '2', 'module_id' => $module->id, 'main_menu_id' => $mm->id])->get();
            foreach ($subMenus as $subMenu) {
                $subMenuRoute[] = ModuleLink::where(['link_type' => '3', 'module_id' => $module->id, 'main_menu_id' => $mm->id, 'sub_menu_id' => $subMenu->id])->get();
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
                $mmRoute[] = $value->url;
            }
        }

        foreach ($smRoutes as $key => $values) {
            foreach ($values as $key => $value) {
                $smRoute[] = $value;
            }
        }


       // dump($sMenus);
        return view('admin.dashboard.index', [
            'module' => $module,
            'mainMenus' => $mainMenus,
            'sMenus' => $sMenus ?? [],
            'moduleRoute' => $moduleRoute ?? [],
            'mmRoute' => $mmRoute ?? [],
            'smRoute' => $smRoute ?? []
        ]);
    }
}
