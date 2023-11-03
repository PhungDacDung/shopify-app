@php
    $r = \Route::current()->getAction();
    $route = (isset($r['as'])) ? $r['as'] : '';
@endphp

<li class="nav-item">
    <a class="sidebar-link {{ Str::startsWith($route, 'home') ? 'active' : '' }}" href="{{ URL::tokenRoute('home') }}">
        <span class="icon-holder">
            <i class="c-blue-500 ti-home"></i>
        </span>
        <span class="title">Home</span>
    </a>
</li>
<li class="nav-item">
    {{-- <a class="btn btn-primary" href="{{ URL::tokenRoute('shopify.popups.create') }}">Edit popup</a> --}}
    <a class="sidebar-link {{ Str::startsWith($route, 'shopify.effects.index') ? 'active' : '' }}" href="{{ URL::tokenRoute('shopify.popups.create') }}">
        <span class="icon-holder">
            <i class="c-blue-500 ti-list"></i>
        </span>
        <span class="title">Popup custom</span>
    </a>
</li>

<li class="nav-item">
    <a class="sidebar-link {{ Str::startsWith($route, 'shopify.instruction') ? 'active' : '' }}" href="{{ URL::tokenRoute('shopify.instruction') }}">
        <span class="icon-holder">
            <i class="c-brown-500 ti-help"></i>
        </span>
        <span class="title">Instruction</span>
    </a>
</li>
