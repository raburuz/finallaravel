<?php

namespace App\Traits;

//namespace
use App\Models\User; 
use App\Models\Type;
use App\Models\Pokemon;
use App\Models\Specie;
use App\Models\Ability; 
use App\Models\Custompoke;
use App\Models\Pokedex;

trait GetData
{
    
    
     /**
     * Get View Per Rol
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function roles(){ return ['admin','user']; }
    
    public function getViewPerRol(){
        $user=Auth()->user()->rol;
        ($user == "user")
            ? 
               $view='user_home'
            :
               $view='admin_home';
               
       return $view;
    }
    
     public function getData($view, $querys){
        $data=[];
        
        if($view === 'admin_home'){
            $data = self::getAdminData($querys);
        }
        
        if($view === 'user_home'){
            $data = self::getUserData($querys);
        }
        
        return $data;
        
    }
    
    
    private function getAdminData($querys){
        
        $data = self::paginates($querys);
        
        $data['canCreatePokemon']= self::isEmptyTable($data['species']) && self::isEmptyTable($data['types']);
        
       // dd($data);
       
    
        return $data;
    }
    
    private function getUserData($querys){
        if(isset($querys['table'])){
         $data['custompokes']= Custompoke::orderBy($querys['sort'], $querys['order'])->paginate(5, ['*'], 'custompokes')->appends(request()->except('custompokes'));
        } else{
         $data['custompokes']= Custompoke::paginate(5);   
        }
         $data['abilitys']   = Ability::all();
        return $data;
    }
    
    
    private function isEmptyTable($model){
        return !empty($model->modelKeys());
    }
    
    private function paginates($querys){
        
      
         $tables=['types','users', 'pokemons','species','abilitys','pokedexs','custompokes'];
         $data=[];
       
         foreach($tables as $table){
             $model ="App\Models\\".substr(ucfirst($table),0, -1);
             $data[$table] = $model::paginate(5, ['*'], $table)->appends(request()->except($table));
          
          
           if(isset($querys['table'])){
               
                $querys['table']= ($querys['table'] == 'users')? substr($querys['table'], 0, -1): $querys['table'];
           
                if( ($querys['table'] == substr($table, 0, -1) )){ //|| $querys['table'] == 'users'
                            
                   
                     $data[$table] = $model::orderBy($querys['sort'], $querys['order'])->paginate(5, ['*'], $table)->appends(request()->except($table));
                    // dd($data);
                 }
               
           }
         
        }
      
        return $data;
    } 
    
    public function getQuerys($request){
        
      $queys['table'] = $request->query('table') ?? null;
      $queys['sort'] = $request->query('sort') ??  null;
      $queys['order'] = $request->query('order') ?? null;
       
      return $queys;  
    }
}