<?php

use App\Http\Controllers\ItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get("items", [ItemController::class, 'index']);
Route::controller(ItemController::class)->group(function () {
    Route::get('items', 'index');
    Route::get('item-create', 'create');
    Route::post('item-create', 'store')->name('item_create');
    Route::get('item-edit/{id}', 'edit');
    Route::put('item-edit/{id}', 'update')->name('item_update');
    Route::get('item-delete/{id}', 'destroy');
});
