<?php

namespace App\Http\Controllers;

use App\Jobs\ShopifyCreateWebhooks;
use App\Jobs\ShopifyLoadProducts;
use App\Models\Background;
use App\Models\Effect;
use App\Models\Store;
use Illuminate\Http\Request;
use PHPShopify\ShopifySDK;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function policy()
    {
        return view("policy");
    }

    public function getEffectify(Request $request)
    {
        // $shop_url = $request->get("shop");
        // $effect = Effect::where("shopify_url", $shop_url)->where("status", 1)->first();
        // if ($effect) {
        //     $template = $effect->template;
        //     return response()->view("shopify.effect_scripts.{$template->name}", ["effect" => $effect])
        //         ->header("Content-Type", "application/javascript")->header("Cache-Control", "no-store, no-cache, must-revalidate");
        // } else
        //     return response("")->header("Content-Type", "application/javascript");
    }
}
