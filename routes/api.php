<?php

use Illuminate\Support\Facades\Route;
use App\Http\Api\ModuleController;
use App\Http\Api\ModuleLinkController;
use App\Models\ModuleLink;
use App\Http\Api\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('module/index', [ModuleController::class, 'index'])->name('module-index');
Route::get('module/create', [ModuleController::class, 'create'])->name('module-create');
Route::post('module/store', [ModuleController::class, 'store'])->name('module-store');
Route::get('module/path/{link}', [ModuleController::class, 'path'])->name('module-path');

Route::get('menu/index', [ModuleController::class, 'menuIndex'])->name('menu-index');
Route::get('menu/create', [ModuleController::class, 'menuCreate'])->name('menu-create');
// Route::post('module/store', [ModuleController::class, 'store'])->name('module-store');
// Route::get('module/path/{link}', [ModuleController::class, 'path'])->name('module-path');

Route::get('module/link/index', [ModuleLinkController::class, 'index'])->name('module-link-index');
Route::get('module/link/create', [ModuleLinkController::class, 'create'])->name('module-link-create');
Route::post('module/link/store', [ModuleLinkController::class, 'store'])->name('module-link-store');

$moduleLink = ModuleLink::where('active_status', 1)->get();
foreach ($moduleLink as $link) {
    $controller = "App\Http\Controllers\\$link->controller";
    $route = "Illuminate\Support\Facades\Route::$link->type";
    call_user_func($route, "/$link->url", [$controller, $link->method])->name($link->name);
}

