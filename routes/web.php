<?php

use Illuminate\Support\Facades\{Route,Auth};
use App\Http\Livewire\{Product,Cart};



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth'] ], function() {
    Route::get('/products', Product::class);
    Route::get('/cart', Cart::class);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});


