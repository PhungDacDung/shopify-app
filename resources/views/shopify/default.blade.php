<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="session-token" data-value="{{ request("token") }}">
    <meta name="session-host" data-value="{{ request("host") }}">
    <title>{{ \Osiset\ShopifyApp\Util::getShopifyConfig('app_name') }}</title>

    <!-- Styles -->
	<link href="{{ mix('/css/app.css') }}" rel="stylesheet">
	{{-- <link href="{{ mix('/css/rtl.css') }}" rel="stylesheet">  --}}

	@yield('css')
    <script>
    </script>
</head>

<body class="app">

    @include('shopify.partials.spinner')

    <div>
        <!-- #Left Sidebar ==================== -->
        {{-- @include('shopify.partials.sidebar') --}}

        <!-- #Main ============================ -->
        <div class="page-container">
            <!-- ### $Topbar ### -->
            @include('shopify.partials.topbar')

            <!-- ### $App Screen Content ### -->
            <main class='main-content '>
                {{-- <div id='mainContent'> --}}
                    <div class="container-fluid">
                        <h4 class="c-grey-900 mT-10 mB-30">@yield('page-header')</h4>
                    </div>
                    @yield('content')
                {{-- </div> --}}
            </main>

            <!-- ### $App Screen Footer ### -->
            {{-- <footer class="bdT ta-c p-30 lh-0 fsz-sm c-grey-600">
                <span>Copyright © {{ date('Y') }} Designed by
                    <a href="#" target='_blank' title="{{ config('app.name', 'Laravel') }}">{{ config('app.name', 'Laravel') }}</a>. All rights reserved.</span>
            </footer> --}}
        </div>
    </div>
    <script src="{{ mix('/js/app.js') }}"></script>
    @if(\Osiset\ShopifyApp\Util::getShopifyConfig('appbridge_enabled') && \Osiset\ShopifyApp\Util::useNativeAppBridge())
        <script src="{{config('shopify-app.appbridge_cdn_url') ?? 'https://unpkg.com'}}/@shopify/app-bridge{{ \Osiset\ShopifyApp\Util::getShopifyConfig('appbridge_version') ? '@'.config('shopify-app.appbridge_version') : '' }}"></script>
        <script src="{{config('shopify-app.appbridge_cdn_url') ?? 'https://unpkg.com'}}/@shopify/app-bridge-utils{{ \Osiset\ShopifyApp\Util::getShopifyConfig('appbridge_version') ? '@'.config('shopify-app.appbridge_version') : '' }}"></script>
        <script
            @if(\Osiset\ShopifyApp\Util::getShopifyConfig('turbo_enabled'))
                data-turbolinks-eval="false"
            @endif
        >
            var AppBridge = window['app-bridge'];
            var actions = AppBridge.actions;
            var utils = window['app-bridge-utils'];
            var createApp = AppBridge.default;

            var app = createApp({
                apiKey: "{{ \Osiset\ShopifyApp\Util::getShopifyConfig('api_key', $shopDomain ?? Auth::user()->name ) }}",
                shopOrigin: "{{ $shopDomain ?? Auth::user()->name }}",
                host: "{{ \Request::get('host') }}",
                forceRedirect: true,
            });
        </script>

        @include('shopify-app::partials.token_handler')
        @include('shopify-app::partials.flash_messages')
    @endif
    @yield('js')
    @stack('scripts')

</body>

</html>
