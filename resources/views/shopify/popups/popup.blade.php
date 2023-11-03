@extends('shopify.default')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/popup.css') }}">

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    @php
        
    $popup = json_decode($data->data, true);
    
@endphp


    <div class="container-fluid ">    
     
        <div class="mb-3 d-flex justify-content-end">
                <a class="btn btn-primary " href="{{  URL::tokenRoute('home') }}">Back</a>
        </div>
        <div class="row h-auto">
            <div class="col-lg-4 overflow-auto p-3 bg-light border border-secondary card shadow-sm  "
            style="height: 520px;">
                <div class="p-2 ml-2">
                    {{ Form::open([
                        'url' => route('shopify.popups.store'),
                        'method' => 'POST',
                        'enctype' => 'multipart/form-data',
                    ]) }}
                    @sessionToken


                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label text-dark">Heading</label>
                        <input type="text" class="form-control inp-heading " name="heading" id="exampleFormControlInput1"
                            value='{{ $popup["heading"] }}' placeholder="" onchange=test()>
                        @if ($errors->has('heading'))
                            <div class="error text-danger ">{{ $errors->first('heading') }}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label text-dark">Description</label>
                        <textarea class="form-control inp-des" name="description" id="exampleFormControlTextarea1" rows="3">{{ $popup["description"] }}</textarea>
                        @if ($errors->has('description'))
                            <div class="error text-danger ">{{ $errors->first('description') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">

                        <div class="custom-file">
                            <label for="exampleInputPassword1" class="text-dark">Image URL</label>
                            <input type="text" class="form-control imageURL" id="exampleInputPassword1" placeholder="http://image_url" name="imageURL" value="{{ $popup["imageURL"] }}">
                            <a href="https://bom.so/">(Please shorten the link before entering)</a>
                            @if ($errors->has('imageURL'))
                                <div class="error text-danger ">{{ $errors->first('imageURL') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label text-dark">Background Color</label>
                        <input type="color" class="background" name="backgroundColor" value="{{ $popup["backgroundColor"] }}">
                        <span class="color">{{ $popup["backgroundColor"] }}</span>
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label text-dark">Text Color</label>
                        <input type="color" class="textColor" name="textColor" value="{{ $popup["textColor"] }}">
                        <span class="text-color">{{ $popup["textColor"] }}</span>
                    </div>

                    <button type="submit" class="btn btn-success mb-2">Save</button>
                    {{ Form::close() }}
                </div>
            </div>


            <div class="col-lg-8 h-auto">

                <div class="popup">
                    {{-- @foreach ($data as $item)
                        @php
                            $popup = json_decode($item->data, true);

                        @endphp --}}
                        <div class="popup-content" style="background-color: {{ $popup['backgroundColor'] }}">
                            <h1 id="heading" style="color: {{ $popup['textColor'] }}; max-width : 400px" class="heading ">
                                {{ $popup['heading'] }}</h1>
                            <span class="close" id="closePopup">&times;</span>
                            <p class="description" style="color: {{ $popup['textColor'] }}; max-width : 400px">{{ $popup['description'] }}
                            </p>
                            <div class="popup-img">
                                <img src="{{$popup['imageURL']}}" alt="" class="img-popup"
                                    style="width:380px">
                            </div>
                            <div>
                                <button class="btn btn-success mt-3 btn-shop">Shop now</button>
                            </div>
                        </div>
                    {{-- @endforeach --}}
                </div>



            </div>
        </div>
    </div>
    </div>
    </div>

    </div>
    </div>

    <script>


        var inputBgColor = document.querySelector('.background');
        var inputTextcolor = document.querySelector('.textColor');
        var heading = document.querySelector('.heading');
        var description = document.querySelector('.description');
        var popupContent = document.querySelector('.popup-content');
        var color = document.querySelector('.color');
        var textcolor = document.querySelector('.text-color');
        var btnClose = document.getElementById('closePopup');
        var inputHeading = document.querySelector('.inp-heading');
        var inputDescription = document.querySelector('.inp-des')
        var imageURL = document.querySelector('.imageURL');
        var img = document.querySelector('.img-popup');
        /* Change heading */
        inputHeading.addEventListener('change', function(element) {
            heading.innerHTML = inputHeading.value;
        });


        /* Change description */
        inputDescription.addEventListener('change', function() {
            description.innerHTML = inputDescription.value;
        });

        /* Change background-color */

        inputBgColor.addEventListener('change', function() {
            popupContent.style.background = inputBgColor.value;
            color.innerHTML = inputBgColor.value;
        });

        /* Change text-color */
        inputTextcolor.addEventListener('change', function() {
            heading.style.color = inputTextcolor.value;
            description.style.color = inputTextcolor.value;
            btnClose.style.color = inputTextcolor.value;
            textcolor.innerHTML = inputTextcolor.value;
        });

        imageURL.addEventListener('change',function(){
            img.onload = () =>{

                img.scr = imageURL.value;
            }
        });
        document.querySelector('.btn-shop').addEventListener('click',function(){
                document.querySelector('.popup').style.display = 'none';

        });


        // var img = document.querySelector('.img-popup');
        // window.addEventListener('load', function() {
        //     document.querySelector('input[type="file"]').addEventListener('change', function() {
        //         if (this.files && this.files[0]) {

        //             img.onload = () => {
        //                 URL.revokeObjectURL(img.src); // no longer needed, free memory
        //             }
        //             img.src = URL.createObjectURL(this.files[0]); // set src to blob url
        //         }
        //     });
        // });
    </script>
@endsection
