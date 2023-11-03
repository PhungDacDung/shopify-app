{{-- @extends('layouts.main') --}}


{{-- @section('content-edit') --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="">
        {{ Form::open([
            'url' => route('shopify.popups.store'),
            'method' => 'POST',
        ]) }}
        @sessionToken
    
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Heading</label>
            <input type="text" class="form-control" name="heading" id="exampleFormControlInput1" placeholder="">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
    
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Upload</span>
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="image" id="inputGroupFile01">
                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
            </div>
        </div>
    
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Background Color</label>
            <input type="color" class="" name="background">
        </div>
    
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Text Color</label>
            <input type="color" class="" name="textColor">
        </div>
    
        <button type="submit" class="btn btn-success">Save</button>
        {{ Form::close() }}
    </div>
</body>
</html>
    
{{-- @endsection --}}
