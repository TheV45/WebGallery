<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;


class ImageController extends Controller
{
    public function create(){
        $images=Image::all();
        return view('mainpage')->with("images",$images);

    }

    public function store(Request $request){
        $images=Image::all();
        $path=$request->file('image')->store('images','s3');

        Storage::disk('s3')->setVisibility($path,'public');

        $image=Image::create([
            'title'=>$request->input('title'),
            'filename'=> basename($path),
            'url'=>Storage::disk('s3')->url($path)
        ]);
        return redirect('/');

    }

    public function show(Image $image){
        return Storage::disk('s3')->response('images/'.$image->filename);

    }
    public function deleteImage(Request $request,$id){
        $findimg=Image::find($id);
        Storage::disk('s3')->delete('images/'. $findimg->filename);
        $findimg->delete();
        return redirect('/')->with('success','Image Deleted Successfully');
    }

}
