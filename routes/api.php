<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"]);

//protected route
Route::middleware("auth:sanctum")->post("/logout", [AuthController::class, "logout"]);

Route::resource("employees", EmployeeController::class);
