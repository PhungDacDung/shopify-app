<?php

namespace App\Http\Controllers\Shopify;

use App\Models\Popup;
use Illuminate\Http\Request;
use App\Http\Service\PopupService;
use App\Http\Controllers\Controller;
use App\Http\Traits\FileLiquid;
use App\http\Traits\ShopifyTrait;
use Illuminate\Support\Facades\Auth;

class PopupController extends Controller
{

    use ShopifyTrait;
    use FileLiquid;

    protected $popupService;

    public function __construct(PopupService $popupService)
    {
        $this->popupService = $popupService;
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
        $shop = auth()->user();

        $shopName = $shop->name;
        $data = Popup::where('shop','=', $shopName)->first();
        if(Popup::where('shop','=', $shopName)->exists()){

            return view('shopify.popups.popup',compact('data'));
        }
        else{
            return view('shopify.popups.popup-default');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shop = auth()->user();
        $request->validate([
            'heading' => 'required',
            'description' => 'required',
            'imageURL' => 'required',
        ]);

        if(Popup::where('shop','=',$shop->name)->exists()){
            
            $this->popupService->update($request);
        }
        else{
            
            $this->popupService->create($request);
        }

        $themeActiveId = $this->getThemeIdActive($shop);
        $fileLayout = "layout/theme.liquid";
        $popup = Popup::where('shop', $shop->name)->first();
        if (!$themeActiveId) {
            return response()->json([
                'type' => 'error',
                'content' => 'Get active theme error!',
            ], 500);
        }
        if ($popup->status === 1) {
            foreach ($popup as $item) {

                $data1 = json_decode($popup->data, true);
                $data = $this->fileLiquid($popup,$data1);
            }
            try {
                $storeFileLiquidToShopify = $this->storeFileLiquidToShopify($shop, $themeActiveId, $data);
                $updateThemeLiquid = $this->updateFileThemeLiquidShopify($shop, $themeActiveId, $fileLayout);
                if ($storeFileLiquidToShopify && $updateThemeLiquid) {
                

                    return back()->withSuccess("Update successfully!");
                    return back()->with('success', "Update successfully!");
                }
            } catch (\Exception $e) {
                
                return back()->with('error', "Update failed");
            }
        } else {
            // return response()->view("shopify.dashboard.dashboard");
            
            try {
                $storeFileLiquidToShopify = $this->deletecursorNotifyToshopfy($shop, $themeActiveId);
                 $deleteUpdateFileThemLiquid = $this->deleteUpdateFileThemLiquid($shop, $themeActiveId, $fileLayout);
                if ($storeFileLiquidToShopify  && $deleteUpdateFileThemLiquid) {

                

                    return back()->with('success', "remove successfully!");
                }
            } catch (\Exception $e) {
                return back()->withSuccess("remove failed!");
            }
        }

    }


    public function enable(Request $request){

        
        $shop = auth()->user();

        $popup = Popup::where('shop','=',$shop->name)->first();
        if($request->status === 'on' ){
            $popup->status = 1;
        }
        else{
            $popup->status = 0;
            $popup->save();
        }

        $themeActiveId = $this->getThemeIdActive($shop);
        $fileLayout = "layout/theme.liquid";
        // $popup = Popup::where('shop', $shop->name)->first();
        if (!$themeActiveId) {
            return response()->json([
                'type' => 'error',
                'content' => 'Get active theme error!',
            ], 500);
        }
        if ($popup->status === 1) {
            foreach ($popup as $item) {

                $data1 = json_decode($popup->data, true);
                $data = $this->fileLiquid($popup,$data1);
            }
            try {
                $storeFileLiquidToShopify = $this->storeFileLiquidToShopify($shop, $themeActiveId, $data);
                $updateThemeLiquid = $this->updateFileThemeLiquidShopify($shop, $themeActiveId, $fileLayout);
                if ($storeFileLiquidToShopify && $updateThemeLiquid) {

                    $popup->save();
                    

                    return back()->withSuccess("Update successfully!");
                    return back()->with('success', "Update successfully!");
                }
            } catch (\Exception $e) {
                
                return back()->with('error', "Update failed");
            }
        } else {
            try {
                $storeFileLiquidToShopify = $this->deletecursorNotifyToshopfy($shop, $themeActiveId);
                 $deleteUpdateFileThemLiquid = $this->deleteUpdateFileThemLiquid($shop, $themeActiveId, $fileLayout);
                if ($storeFileLiquidToShopify  && $deleteUpdateFileThemLiquid) {

                    return back()->with('success', "remove successfully!");
                }
                return back();
            } catch (\Exception $e) {
                return back()->withSuccess("remove failed!");
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        dd(1);

        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    


}
