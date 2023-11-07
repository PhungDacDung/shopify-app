<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\http\Traits\ShopifyTrait;

class ShopifyController extends Controller
{
    use ShopifyTrait;
    /*  webhook customers/data_request */
    public function customersDataRequest(Request $request)
    {
        return response()->json(
            [
                
            ],
            200
        );
    }

    /*  webhook customers/redact */
    public function customersRedact(Request $request)
    {
        return response()->json(
            [],
            200
        );
    }

    public function shopRedact(Request $request)
    {

        $getUser = User::where('name', $request->shop_domain)->first();
        if ($getUser) {
            $getUser->delete();
        }
        return response()->json(
            [],
            200
        );
    }
    public function app_uninstalled(Request $request)
    {
        $shop = User::where('name', $request->domain)->delete();

        return response()->json(["status" => "succeed"]);
    }

}
