<?php

namespace App\Http\Controllers;

use App\Models\Ability;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\SkillRequest;
use App\Http\Requests\SkillStoreRequest;

class AbilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->middleware('redirect')->only(['index', 'show']);
        $this->middleware('skill')->only('update');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
        //
    }
     
     
    public function create()
    {
        return view('ability.create');
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
                 $ability = new Ability(['name' => $name]);
                 $ability->save();
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
     * @param  \App\Models\Ability  $ability
     * @return \Illuminate\Http\Response
     */
    public function show(Ability $ability)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ability  $ability
     * @return \Illuminate\Http\Response
     */
    public function edit(Ability $ability)
    {
        return view('ability.edit', $ability);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ability  $ability
     * @return \Illuminate\Http\Response
     */
    public function update(SkillRequest $request, Ability $ability)
    {
       
       
        try{
           $ability->update($request->all());
           $ability->save();
        }
        catch(\Exception $e){
           return back()->withInput();
        }
        return redirect('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ability  $ability
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ability $ability)
    {
        try{
            $ability->delete();
        }
        catch(\Exception $e){
           return redirect('home');
        }
        return redirect('home');
    }
}
