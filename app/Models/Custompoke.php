<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

//namespace
use App\Models\Ability;
use App\Models\Pokedex;
use App\Models\Pokemon;

class Custompoke extends Model
{
    use HasFactory;
    use SoftDeletes;
    
     protected $table = 'custompoke';
         
     protected $fillable = ['nickname', 'height', 'weight', 'ability_id', 'pokemon_id', 'pokedex_id']; 
    
     public $timestamps = true;
     
      /** 
     *  The Inverse Of The Relationship
     * 
     *  Custompoke --- 1,1 ---->Ability
     */
      public function ability()
     {
        return $this->belongsTo(Ability::class, 'ability_id');
     }
     
     public function pokemon(){
          return $this->belongsTo(Pokemon::class, 'pokemon_id');
     }
     
     /** 
     *  Add PIVOT!
     *  Many to Many // hasMany?
     *  Pokemon --- 1,n ---- pokedex_pokem (N:M ) Pivot ---- 1,n ----Pokedex
     */
     public function pokedex()
    {
        return $this->belongsTo(Pokedex::class)
            ->withPivot();
            //withPivot('user_id');
    }
    
     public function hola()
    {
        return 'hola';
    }
    
   
        
}
