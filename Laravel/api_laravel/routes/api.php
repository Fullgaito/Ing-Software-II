<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IngredientController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Http;


/********** Rutas para el controlador de usuarios **********/
Route::get("/users",[UserController::class, "index"]);
Route::post("/users",[UserController::class, "store"]);
Route::put("/users/{id}",[UserController::class, "update"]);
Route::delete("/users/{id}",[UserController::class, "destroy"]);


Route::get("/ingredients",[IngredientController::class, "index"]);
Route::post("/ingredients",[IngredientController::class, "store"]);
Route::put("/ingredients/{id}",[IngredientController::class, "update"]);
Route::delete("/ingredients/{id}",[IngredientController::class, "destroy"]);


Route::get('/prueba', function () {
    return redirect('https://fakestoreapi.com/products');
});

Route::get('/prueba2', function () {
    return ('https://fakestoreapi.com/products');
});

Route::get('/prueba3', function () {
    return
    $response = Http::get('https://fakestoreapi.com/products')
    ->json();
});