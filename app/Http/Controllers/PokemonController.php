<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Http\Request;

//namespace
use App\Models\Type;
use App\Models\Specie;
use App\Models\Image;
use App\Models\Ability;
use App\Http\Controllers\ImageController;

//Request
use App\Http\Requests\PokemonStoreRequest;
use App\Http\Requests\PokemonUpdateRequest;


class PokemonController extends Controller
{
    
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->except(['index']);
        $this->middleware('verified');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abilitys = Auth()->user()->rol =='user' ? Ability::all() : '';
        
        $data['abilitys']= $abilitys;
        $data['pokemons']=Pokemon::all();
        return view('pokemon.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['types']=Type::all();
        $data['species']=Specie::all();
        return view('pokemon.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PokemonStoreRequest $request)
    {
        try{
            $pokemon= new Pokemon($request->all());
            $pokemon->save();
            $request['imageable_id'] = $pokemon->id;
            $isImageCreate=$this->createImage($request);
      }
        catch(\Exception $e){
              
        }
        return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pokemon  $pokemon
     * @return \Illuminate\Http\Response
     */
    public function show(Pokemon $pokemon)
    {
        $data['pokemon']=$pokemon;
        $data['link']= '/storage/img/'.($pokemon->image->file_name ?? '');
      //  dd($data);
        return view('pokemon.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pokemon  $pokemon
     * @return \Illuminate\Http\Response
     */
    public function edit(Pokemon $pokemon)
    {
        
        $data['types']=Type::all();
        $data['species']=Specie::all();
       // dd($pokemon);
        return view('pokemon.edit', $pokemon)->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pokemon  $pokemon
     * @return \Illuminate\Http\Response
     */
    public function update(PokemonUpdateRequest $request, Pokemon $pokemon)
    {
        //Edit Image File
        $hasFile= $this->hasOneFile($request->file('avatar'));
        $hasFile && $this->updateImage($request, $pokemon->image->id);
        
        try{
            $pokemon->update($request->all());
            $pokemon->save();
        }
        catch(\Exception $e){
            return back()->withInput;
        }
        
        return redirect('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pokemon  $pokemon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pokemon $pokemon)
    {
        //softDelete
        try{
            $pokemon->delete();
        }
        catch(\Exception $e){
           return redirect('home');
        }
        return redirect('home');
    
    }
    
    private function createImage( $request){

        $file = Image::getDataFromImage($request);
        
        //Upload img and save img
        $isUploaded = Image::isUploadImageToStorage($file);
        
        ($isUploaded) && Image::saveImageInDataBase($file);
        
        return redirect('home');
        
    }
    
    private function updateImage($request, $image_id){
         //Get img from database
         $image = Image::find($image_id);
         $file = Image::getDataFromImage($request);
         Image::deleteImageFromStorage($image);
         $isUploaded = Image::isUploadImageToStorage($file);
         ($isUploaded) && Image::updateImageInDataBase($image, $file);
       
         return redirect('home');
    }
    
    /**
    * Has One File? If have new file update image
    * 
    * @param $file Image File
    * 
    * @return boolean 
    */
    private function hasOneFile($file){
        
        if($file != null){
            return true;
        }
        
        return false;
    }
    
    
    
    
}
