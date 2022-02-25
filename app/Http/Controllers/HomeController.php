<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//namespace
use App\Models\User; 
use App\Models\Type;
use App\Models\Pokemon;
use App\Models\Specie;
use App\Models\Ability; 
use App\Models\Custompoke;
use App\Models\Pokedex;
 
class HomeController extends Controller 
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $querys = User::getQuerys($request);
        //dd($querys);
        $order = User::getfilters();
         
        $view = User::getViewPerRol();
    
        $data = User::getData($view, $querys);
      
        $data= array_merge($data,$order);
        
     
        $data['haveImage'] = (Auth()->user()->image) ? true : false;
       
       //dd($data);
        return view($view, $data);
    }
    
   
   
}
