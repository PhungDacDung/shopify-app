@extends('shopify.default')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/popup.css') }}">

    <div class="container-fluid px-0">
        <div class="row g-0">
            <div class="col-lg-4 border-right card shadow-sm w-25 my-5 h-100">
                {{-- @include('shopify.popups.edit') --}}

                {{ Form::open([
                    'url' => route('shopify.popups.store'),
                    'method' => 'POST',
                    'enctype' => 'multipart/form-data',
                ]) }}
                @sessionToken

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Heading</label>
                    <input type="text" class="form-control inp-heading" name="heading" id="exampleFormControlInput1"
                        value="" placeholder="" onchange=test()>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                    <textarea class="form-control inp-des" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>

                <div class="input-group mb-3">
        
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="image" id="inputGroupFile01">
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Background Color</label>
                    <input type="color" class="background" name="backgroundColor">
                    <span class="color"></span>
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Text Color</label>
                    <input type="color" class="textColor" name="textColor">
                    <span class="text-color"></span>
                </div>

                <button type="submit" class="btn btn-success">Save</button>
                {{ Form::close() }}

            </div>

            <div class="col-lg-8 card shadow-sm  ">
            

                @foreach ($data as $item)
                    @php
                        $popup = json_decode($item->data, true);

                    @endphp

                    <div class="popup">
                        <div class="popup-content" style="background-color: {{ $popup['backgroundColor'] }}">
                            <h1 id="heading" style="color: {{ $popup['textColor'] }}" class="heading">
                                {{ $popup['heading'] }}</h1>
                            <span class="close" id="closePopup">&times;</span>
                            <p class="description" style="color: {{ $popup['textColor'] }}">{{ $popup['description'] }}</p>
                            <div class="popup-img">
                                <img src="{{ asset('images/' . $item->img) }}" alt="" class="img-popup"
                                    style="width:380px">
                            </div>
                            <div>
                                <button class="btn btn-success mt-3">Shop now</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

    <script>
        // script.js
        // document.getElementById('openPopup').addEventListener('click', function() {
        //     document.getElementById('popup').style.display = 'block';
        // );

        window.addEventListener('load', function() {
            
            document.getElementById('popup').style.display = 'block';
        });

        document.getElementById('closePopup').addEventListener('click', function() {
            document.getElementById('popup').style.display = 'none';
        });

        // Đóng popup khi người dùng nhấn bất kỳ nơi nào bên ngoài popup

        window.addEventListener('click', function(event) {
            var popup = document.getElementById('popup');
            if (event.target == popup) {
                popup.style.display = 'none';
            }
        });

        // var inputHeading = document.querySelector('.inp-heading');
        // var inputHeading = document.getElementByName('heading');
        // var inputDescription = document.getElementByName('description');
        var inputBgColor = document.querySelector('.background');
        var inputTextcolor = document.querySelector('.textColor');
        var heading = document.querySelector('.heading');
        // var heading = document.querySelector('.heading');
        // var inputDescription = document.querySelector('.inp-description');
        var description = document.querySelector('.description');
        // // var inputBgColor = document.querySelector('.input-bgcolor');
        var popupContent = document.querySelector('.popup-content');
        var color = document.querySelector('.color');
        // // var inputTextcolor = document.querySelector('.input-textcolor');
        var textcolor = document.querySelector('.text-color');
        // var btnUpload = document.querySelector('.btn-upload');
        var btnClose = document.getElementById('closePopup');
        // var popup = document.querySelector('.popup');

        var inputHeading = document.querySelector('.inp-heading');
        var inputDescription = document.querySelector('.inp-des')
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


        var img = document.querySelector('.img-popup');
        window.addEventListener('load', function() {
            document.querySelector('input[type="file"]').addEventListener('change', function() {
                if (this.files && this.files[0]) {

                    img.onload = () => {
                        URL.revokeObjectURL(img.src); // no longer needed, free memory
                    }
                    img.src = URL.createObjectURL(this.files[0]); // set src to blob url
                }
            });
        });

    </script>
@endsection
