@extends('shopify.default')

@section('page-header')
    Hello, {{ auth()->user()->name }}
@endsection
@section('content')
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>

    @php
        use App\Models\Popup;

        $popup = Popup::where('shop',auth()->user()->name)->first();

    @endphp
    

    <div class="card shadow-sm my-5 h-100">
        <div class="card-body ">
            <span class="mr-4 text-dark h5">Let's custom your own popup</span>
            <a class="btn btn-primary" href="{{ URL::tokenRoute('shopify.popups.create') }}">Customize Popup</a>
        </div>
    </div>


    <div class="card shadow-sm my-5 h-100">
        <div class="card-body ">
            {{ Form::open([
                'url' => route('shopify.enable'),
                'method' => 'POST',
            ]) }}
            @sessionToken
            {{-- <span class = "h4 ml-3 mt-3">Active Popup</span> --}}
            <h4 class="text-dark">Enable Popup</h4>
            <label class="switch">
                <input onchange="this.form.submit()" class="" name="status" value='on'  type="checkbox"  @isset($popup) @if ($popup->status == 1) checked @endif @endisset>
                <span class="slider round"></span>
            </label>
            {{ Form::close() }}

        </div>
    </div>

    <div class="card shadow-sm my-5 h-100">
        <div class="card-body">
            <h4 class="text-dark mb-3">FAQ</h4>

            <div>
                <p class="text-dark">The app isn't working for my store</p>
                <p>Send us a live chat message any time. We usually respond in less than one minute</p>
            </div>

          
        </div>
      </div>


      <div class="card shadow-sm my-5 h-100">
        <div class="card-body ">
            <h4 class="text-dark mb-3">Instruction</h4>
            <p class="text-dark"></p>
            <a href="{{ URL::tokenRoute('shopify.instruction') }}">View detail instruction</a>


        </div>
    </div>


    <script></script>
@endsection
