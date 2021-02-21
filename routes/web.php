<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
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

// Route::get('/', function () {
    // $path = storage_path('app/public/14/課本');
    // $files = File::Files($path);
    // $dir = scandir($path);
    // dd($files);
    // $a = "";
    // foreach ($files as $file) {
    //     $a .= $file->getFileInfo() . "\n";
    // }
    // dd($a);
    // return response()->download($path);
    // return view('welcome');
// });

Route::get('/', [BookController::class,'index']);

Route::resource('books', BookController::class);

