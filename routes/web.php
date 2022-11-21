<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User;
use App\Http\Controllers\Examination;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user/list', [User\ListController::class, 'index'])->name('user.list');
Route::get('/user/detail/{userid}', [User\DetailController::class, 'index'])->name('user.detail.id');
Route::match(['get', 'post'], '/user/register/input', [User\RegisterController::class, 'input'])->name('user.register.input');
Route::post('/user/register/confirm', [User\RegisterController::class, 'confirm'])->name('user.register.confirm');
Route::post('/user/register/execute', [User\RegisterController::class, 'execute'])->name('user.register.execute');
Route::get('/user/register/complete', [User\RegisterController::class, 'complete'])->name('user.register.complete');

Route::get('/examination/list/', [Examination\ListController::class, 'index'])->name('examination.list');
Route::match(['get', 'post'], '/examination/register/{userid}/input', [Examination\RegisterController::class, 'input'])->name('examination.register.input');
Route::post('/examination/register/{userid}/confirm', [Examination\RegisterController::class, 'confirm'])->name('examination.register.confirm');
Route::post('/examination/register/{userid}/execute', [Examination\RegisterController::class, 'execute'])->name('examination.register.execute');
Route::get('/examination/register/complete', [Examination\RegisterController::class, 'complete'])->name('examination.register.complete');
