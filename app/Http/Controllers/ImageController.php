<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

// import the storage facade
use Illuminate\Support\Facades\Storage;

//request
use App\Http\Requests\ImagenRequest;

class ImageController extends Controller
{
    
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('redirect')->except(['update','store']);
        $this->middleware('verified');
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImagenRequest $request)
    {
        $file = Image::getDataFromImage($request);
        
        //Upload img and save img
        $isUploaded = Image::isUploadImageToStorage($file);
        
        ($isUploaded) && Image::saveImageInDataBase($file);
        
        return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(ImagenRequest $request, Image $image)
    {
        $file = Image::getDataFromImage($request);
        Image::deleteImageFromStorage($image);
        $isUploaded = Image::isUploadImageToStorage($file);
        ($isUploaded) && Image::updateImageInDataBase($image, $file);

        return redirect('home');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        //
    }
    
    
}
