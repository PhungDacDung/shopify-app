@extends('shopify.default')

@section('page-header')
    Hello, {{ auth()->user()->name }}
@stop
@section('content')
    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <div class="row mt-1">
            <div class="col-md-12">
                <dl>
                    <dt>Step 1</dt>
                    <dd>
                        After install <b>PopupQuickly</b>, click <i>Templates</i> menu to show the available effects.
                    </dd>
                    <dt>Step 2</dt>
                    <dd>
                        Click to <i>New popup</i> to create new popup<br>
                        Select the template then fill the form and submit to save your effect.<br>
                        <img src="{{ asset("images/instructions/step 2.jpg") }}" class="w-50 text-center">
                    </dd>
                    <dt>Step 3</dt>
                        After you save your effect, you will be redirect to the effects manage page.<br>
                        Go to <i>Dashboard</i>, you can see the option to turn on/off the PopupQuickly.<br>
                        Note: When you turn on the Popuptify, the active effect will be applied to show in the front page.<br>
                        You need to wait a short time for the effect to show on the frontpage, it is about 3-5 minutes.
                    <dd>
                    </dd>
                </dl>
            </div>
        </div>
    </div>
@stop
