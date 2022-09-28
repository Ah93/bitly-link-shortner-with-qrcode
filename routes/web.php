<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\urlShortner_qrcode_generator;

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
    return view('index');
});

// Route::get('/getUrl', function () {
//     return view('/getUrl');
// });
// Route::get('/', [urlShortner_qrcode_generator::class, 'index']);
Route::get('/get-link', [urlShortner_qrcode_generator::class, 'index']);

