<?php

namespace App\Http\Controllers;

use App\Models\Pokedex;
use App\Models\Ability;
use Illuminate\Http\Request;

class PokedexController extends Controller
{
    
     public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->middleware('redirect')->except(['show']);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pokedex  $pokedex
     * @return \Illuminate\Http\Response
     */
    public function show(Pokedex $pokedex)
    {
        $data['pokedex']= $pokedex;
        $data['pokemons']= $pokedex->pokemons;
        $data['abilitys']= Ability::all();
      
        return view('pokedex.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pokedex  $pokedex
     * @return \Illuminate\Http\Response
     */
    public function edit(Pokedex $pokedex)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pokedex  $pokedex
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pokedex $pokedex)
    {
      
     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pokedex  $pokedex
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pokedex $pokedex)
    {
        //
    }
}
