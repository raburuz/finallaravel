<?php

namespace App\Http\Controllers;

use App\Models\Specie;
use Illuminate\Http\Request;
use App\Http\Requests\SkillRequest;
use Illuminate\Support\Str;
use App\Http\Requests\SkillStoreRequest;

class SpecieController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->middleware('redirect')->only(['show', 'index']);
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
          return view('specie.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SkillStoreRequest $request)
    {
        $names = $request->input('name');
        
        foreach($names as $name){
              try{
                 $name = Str::of($name)->trim()->lower();
                 $specie = new Specie(['name' => $name]);
                 $specie->save();
              }
              catch(\Exception $e){
                   return redirect('home');
              }
        }
     
        return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Specie  $specie
     * @return \Illuminate\Http\Response
     */
    public function show(Specie $specie)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Specie  $specie
     * @return \Illuminate\Http\Response
     */
    public function edit(Specie $specie)
    {
         return view('specie.edit', $specie);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Specie  $specie
     * @return \Illuminate\Http\Response
     */
    public function update(SkillRequest $request, Specie $specie)
    {
       try{
           $specie->update($request->all());
           $specie->save();
       }
       catch(\Exception $e){
           return back()->withInput();
       }
        return redirect('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Specie  $specie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Specie $specie)
    {
        try{
            $specie->delete();
        }
        catch(\Exception $e){
           return redirect('home');
        }
        return redirect('home');
    }
}
