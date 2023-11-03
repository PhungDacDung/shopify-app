<div class="header navbar ">
    <div class="header-container">
        <ul class="nav-left">

            <div class="sidebar-logo">
                <div class="peers ai-c fxw-nw">
                    <div class="peer peer-greed">
                        <a class='sidebar-link td-n' href="{{ URL::tokenRoute("home") }}">
                            <div class="peers ai-c fxw-nw">
                                <div class="peer">
                                    <div class="logo mt-3">
                                        <img src="/images/logo-1.png" alt="">
                                    </div>
                                </div>
                                <div class="peer peer-greed">
                                    <h5 class="lh-1 mB-0 logo-text">{{ config('app.name', 'Laravel') }}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="peer">
                        <div class="mobile-toggle sidebar-toggle">
                            <a href="" class="td-n">
                                <i class="ti-arrow-circle-left"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>


        </ul>
        <ul class="nav-right">
            <li>
                <a href="#" class="balance-notify-text ">
                    <span class="font-weight-bolder ">{{ auth()->user()->name }}</span>
                </a>
            </li>
        </ul>
        
    </div>
</div>
