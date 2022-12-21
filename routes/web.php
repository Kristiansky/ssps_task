<?php

    use App\Http\Controllers\ChannelController;
    use Illuminate\Support\Facades\Route;

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

Route::get('/', [ChannelController::class, 'index']);
Route::get('/import', [ChannelController::class, 'import']);
Route::post('/store', [ChannelController::class, 'store']);
Route::view('/batch', '/channels/batch')->name('batch');
Route::post('/store-batch', [ChannelController::class, 'storeBatch']);
Route::resource('channels', ChannelController::class);
