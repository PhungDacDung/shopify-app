<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use DateTime;
use Exception;
use Carbon\Carbon;
use App\Models\User;
use RuntimeException;
use App\Models\Charge;
use Osiset\ShopifyApp\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Osiset\ShopifyApp\Contracts\ShopModel as IShopModel;

class BillableMiddleware
{
    /**
     * Handle an incoming request.
     * @param Request
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     * @throws Exception
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        $charge_ = Charge::withTrashed()->where('user_id', $user->id)->latest('deleted_at')->first();
        if (Util::useNativeAppBridge() === false) {
            throw new RuntimeException('You cannot use Billable middleware with SPA mode');
        }

        if (Util::getShopifyConfig('billing_enabled') === true) {
            /** @var $shop IShopModel */
            $shop = auth()->user();
            if ($charge_) {
                $billingOn = Carbon::parse($charge_->billing_on);
                $billingOnDateCancelled = $billingOn->addDays(30);
                $now = Carbon::now();
                // dd($now->toDateString(), $billingOnDateCancelled->toDateString());
                if ($now->gt($billingOnDateCancelled)) {
                    $charge_->status = "FROZEN";
                    $charge_->save();
                    return $next($request);
                } else {
                    $charge_->status = "ACTIVE";
                    $charge_->cancelled_on = null;
                    $charge_->deleted_at = null;
                    $charge_->expires_on = null;
                    $charge_->deleted_at = null;
                    $charge_->save();
                    return $next($request);
                }
            }
            if (!$shop->plan && !$shop->isFreemium() && !$shop->isGrandfathered()) {
                // They're not grandfathered in, and there is no charge or charge was declined... redirect to billing
                return Redirect::route(
                    Util::getShopifyConfig('route_names.billing'),
                    array_merge($request->input(), [
                        'shop' => $shop->getDomain()->toNative(),
                        'host' => $request->get('host'),
                    ])
                );
            }
        }
        // Move on, everything's fine
        return $next($request);
    }
}
