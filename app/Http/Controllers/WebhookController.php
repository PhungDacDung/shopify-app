<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebhookController extends Controller
{

    public function handleUninstall(Request $request)
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

}
