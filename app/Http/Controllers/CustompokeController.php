<?php

namespace App\Http\Controllers;

use App\Models\Custompoke;
use Illuminate\Http\Request;
use App\Http\Requests\CustomPokeRequest;

class CustompokeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('redirect')->except(['update','store','destroy']);
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
    public function store(CustomPokeRequest $request)
    {
        
       try{
        
           $custompoke= new Custompoke($request->all());
           $custompoke->save();
       }
       catch(\Exception $e){
           
           return back()->withInput();
       }
        return redirect('pokemon');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Custompoke  $custompoke
     * @return \Illuminate\Http\Response
     */
    public function show(Custompoke $custompoke)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Custompoke  $custompoke
     * @return \Illuminate\Http\Response
     */
    public function edit(Custompoke $custompoke)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Custompoke  $custompoke
     * @return \Illuminate\Http\Response
     */
    public function update(CustomPokeRequest $request, Custompoke $custompoke)
    {
       try{
           $custompoke->update($request->all());
           $custompoke->save();
       }
       catch(\Exception $e){
           return back()->withInput();
       }
       
       return redirect('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Custompoke  $custompoke
     * @return \Illuminate\Http\Response
     */
    public function destroy(Custompoke $custompoke)
    {
       
       try{
           $custompoke->delete();
       }
       catch(\Exception $e){
          return back()->withInput();
       }
       
       return redirect('home');
    }
    
    
}
