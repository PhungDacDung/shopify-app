<?php

namespace App\Http\Service;

use App\Models\Popup;
use Illuminate\Support\Facades\Request;

class PopupService{
    
    function create($request){

        $name = auth()->user()->name;
        
        $heading = $request->get('heading');
        $description = $request->get('description');
        $imageURL = $request->get('imageURL');
        $background = $request->get('backgroundColor');
        $textColor = $request->get('textColor');

        $array = [
            'heading' => $heading,
            'description' => $description,
            'imageURL' => $imageURL,
            'backgroundColor' => $background,
            'textColor' => $textColor,

        ];

        $data = json_encode($array);

        // if($request->hasFile('image')){
        //     $request->file('image')->move('images', $request->file('image')->getClientOriginalName());
        //     $img = $request->file('image')->getClientOriginalName();
        // }
        

        $popup = new Popup();
        $popup->shop = $name;
        $popup->data = $data;

        $popup->save();
        // return redirect()->to(route("layouts.main"));
        
    }

    function update($request){

        $name = auth()->user()->name;

        $heading = $request->get('heading');
        $description = $request->get('description');
        $imageURL = $request->get('imageURL');
        $background = $request->get('backgroundColor');
        $textColor = $request->get('textColor');

        $array = [
            'heading' => $heading,
            'description' => $description,
            'imageURL' => $imageURL,
            'backgroundColor' => $background,
            'textColor' => $textColor,

        ];
        
        $data = json_encode($array);
        
        $popup = Popup::where('shop','=',$name)->first();

        $popup->data = $data;
        
        // if($request->hasFile('image')){
        //     $request->file('image')->move('images', $request->file('image')->getClientOriginalName());
        //     $img = $request->file('image')->getClientOriginalName();
        //     $popup->img = $img;
        // }
        // else{
        //     $popup->img = $popup->img;
        // }

        $popup->save();
        
        // return redirect()->to(route("layouts.main"));

    }
}