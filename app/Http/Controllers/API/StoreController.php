<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    protected $api_key, $api_secret, $scope;

    public function __construct()
    {
        $this->api_key = env("SHOPIFY_API_KEY", "cccca391c320ba0bf170dc524152eb57");
        $this->api_secret = env("SHOPIFY_SECRET", "5fbbd2d442cc8e69eb701275656efd66");
        $this->scope = env("SHOPIFY_SCOPE", "read_products,read_orders,write_orders,write_script_tags,read_script_tags,write_products");
    }


    public function webHook(Request $request)
    {
        $topic = $request->server('HTTP_X_SHOPIFY_TOPIC', "");
        $shop = $request->server('HTTP_X_SHOPIFY_SHOP_DOMAIN', "");
        $data = file_get_contents('php://input');
		\Log::warning($topic);
        switch ($topic) {
            case 'products/update':
            case 'products/create':
            case 'products/delete':
                break;
            case 'collections/update':
            case 'collections/create':
            case 'collections/delete':
            case 'orders/create':
            case 'orders/updated':
            case 'orders/fulfilled':
            case 'orders/paid':
            case 'orders/partially_fulfilled':
            case 'orders/delete':
            case "app/uninstalled":
                $store = json_decode($data, true);
                \Log::info($store);
                User::where("name", $shop)->delete();
                break;
            default:
                \Log::info($topic);
                \Log::info(json_decode($data, true));
                break;
        }
        return response()->json(["status" => "succeed"]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
