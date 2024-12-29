<?php

use App\Http\Controllers\admin\auth\loginController;
use Illuminate\Support\Facades\Route;

Route::prefix("auth/")->middleware(['guest:admin'])->as("auth.")->group(function () {
    Route::get("login", [loginController::class, "create"])->name("login");
    Route::post("login", [loginController::class, "store"])->name("store");
});
Route::middleware(['auth:admin'])->as("auth.")->group(function () {
    Route::get("logout", [loginController::class, "destroy"])->name("logout");
});
