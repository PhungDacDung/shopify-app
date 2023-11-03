<?php

use App\Http\Controllers\Shopify\PopupController;


Route::group(['middleware' => ["verify.shopify","billable"]], function () {
    Route::get('/', "Shopify\DashboardController@index")->middleware([])->name("home");
    Route::group(["as" => "shopify.", "namespace" => "Shopify"], function () {
        
        Route::post('enable',[PopupController::class,'enable'])->name('enable');
        Route::resource("popups", "PopupController");
        Route::get("instruction", "DashboardController@instruction")->name("instruction");
    });
});

Route::get('policy', 'HomeController@policy')->name("policy");
