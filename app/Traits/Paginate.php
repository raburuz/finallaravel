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

trait Paginate
{
    
    public function getfilters(){
        //sort //name //id //etc
        //order //asc //desc
        $data['usersOrder']=self::createQuery(new User());
        $data['typeOrder']=self::createQuery(new Type());
        $data['pokemonOrder']=self::createQuery(new Pokemon());
        $data['specieOrder']=self::createQuery(new Specie());
        $data['abilityOrder']=self::createQuery(new Ability());
        $data['pokedexOrder']=self::createQuery(new Pokedex());
         $data['custompokeOrder']=self::createQuery(new Custompoke());
       // dd($data);
        return $data;
    }
    
    private function createQuery($model){
         $data = [];
         $tableName=$model->getTable();
         $orders = ['asc', 'desc'];
         $sorts = self::getModelAttributes($model);
         foreach($orders as $order){
             foreach($sorts as $sortindex => $sort){
                 $data['order' . $sortindex . $order] = array_merge(['table'=> $tableName,'sort' => $sortindex, 'order' => $order]);
             }
         }
         return $data;
        
    }
    
    private function getModelAttributes($model){
        $attributes=[];
        $columns = $model->getFillable();
        $attributes = array_merge(array_flip($columns), $attributes);
        $attributes['id']=0;
        return $attributes;
        
    }
    
    
   
}