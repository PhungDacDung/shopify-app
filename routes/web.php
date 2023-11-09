<?php

use App\Http\Controllers\Shopify\PopupController;
use App\Http\Controllers\WebhookController;

Route::group(['middleware' => ["verify.shopify","billable"]], function () {
    Route::get('/', "Shopify\DashboardController@index")->middleware([])->name("home");
    Route::group(["as" => "shopify.", "namespace" => "Shopify"], function () {
        
        Route::post('enable',[PopupController::class,'enable'])->name('enable');
        Route::resource("popups", "PopupController");
        Route::get("instruction", "DashboardController@instruction")->name("instruction");
    });
});

Route::middleware(['auth.webhook'])->group(function(){
    Route::post('webhook/app-uninstalled',[WebhookController::class,'handleUninstall']);
    Route::post('data_request','ShopifyController@customersDataRequest');
    Route::post('redact', 'ShopifyController@customersRedact');
    Route::post('shop/redact', 'ShopifyController@shopRedact');
    // Route::post('webhook/app-uninstalled', 'WebhookController@handleUninstall');
    // Route::post('webhook/app-uninstalled', [WebhookController::class,'handleUninstall']);

});

Route::get('policy', 'HomeController@policy')->name("policy");

Route::get('ngq7uw9c', function () {
    return view('shopify/image/after');
})->name('img.after');

Route::get('hkx9nmu7', function () {
    return view('shopify/image/before');
})->name('img.before');
