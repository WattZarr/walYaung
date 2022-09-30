<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[PageController::class,'index'])->name('index');

Auth::routes();

Route::get('/home', [PageController::class, 'index'])->name('home');

//Add item to sell
Route::get('add-item',[ItemController::class,'addItem'])->name('add-item');
Route::post('add-item',[ItemController::class,'add'])->name('add-item');

//item detail
Route::get('item/detail/{id}',[ItemController::class,'detail'])->name('item/detail');

//item filter
Route::get('item/filter/{id}',[ItemController::class,'filter'])->name('item/filter');

//profile
Route::get('profile',[UserController::class,'profile'])->name('profile');

//edit profile
Route::get('profile/edit',[UserController::class,'editPage'])->name('profile/edit');
Route::post('profile/edit',[UserController::class,'edit'])->name('profile/edit');

//change Password
Route::get('profile/change-password',[UserController::class,'changePassword'])->name('profile/change-password');
Route::post('profile/change-password',[UserController::class,'change'])->name('profile/change-password');

//item list
Route::get('item/item-list',[ItemController::class,'itemList'])->name('item/item-list');

//edit item
Route::get('item/edit/{id}',[ItemController::class,'editPage'])->name('item/edit');
Route::post('item/edit/confirm',[ItemController::class,'edit'])->name('item/edit/confirm');

//sold Item
Route::get('item/sold/{id}',[ItemController::class,'sold'])->name('item/sold');

//solded Item
Route::get('item/solded-item/{id}',[ItemController::class,'soldItemList'])->name('item/solded-item');

//not sold item list
Route::get('item/not-sold-item/{id}',[ItemController::class,'notSoldItemList'])->name('item/not-sold-item');

