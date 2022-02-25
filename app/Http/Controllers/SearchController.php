<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;


use App\Models\User; 

class SearchController extends Controller
{
    public function search(Request $request){
        
        $model= $this->getModel($request->mytableSearch);
        
        $querys = User::getQuerys($request);
        $order = User::getfilters();
        $view= User::getViewPerRol();
        
        $data= User::getData($view, $querys);
        $data['haveImage'] = (Auth()->user()->image) ? true : false;
        
        if($model != null){
             $data['results']=$model::where('name','like','%'. $request->input('query').'%')->get();
        }
        if($request->mytableSearch == 'pokedex'){
             $data['results']=User::where('name','like','%'. $request->input('query').'%')
             ->where('rol','!=','admin' )
             ->get(); //and != null
        }
      
        
        $data= array_merge($data,$order);
        
        //dd($data);
        return view('admin_home',$data);
    }
    
    private function getModel($model){
        
        $models=["ability","user","pokemon","custompoke","specie",'type'];
        
        if(in_array($model,$models)){
            $modelForSearch=ucfirst(trans($model));
            return "App\Models\\".$modelForSearch;
        }
        return null;
    }
    
   
}
