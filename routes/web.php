<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\productFeedbackController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => '/admin', 'middleware'=>['disable_back_button']], function(){
    // user
    Route::resource('user', UserController::class);
//    product
    Route::resource('product', productFeedbackController::class);
   
    


});

    Route::get('', [productFeedbackController::class, 'indexUser'])->name('indexUser');
    Route::post('/vote/{type}/{productId}', [productFeedbackController::class, 'vote'])->name('vote');
    Route::post('', [productFeedbackController::class, 'comment'])->name('comments.store');

    

