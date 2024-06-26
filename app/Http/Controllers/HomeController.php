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
    
    }
}
