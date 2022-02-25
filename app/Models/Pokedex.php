<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//namespace
use App\Models\User;
use App\Models\Custompoke;


class Pokedex extends Model
{
    use HasFactory;
    
    protected $table = 'pokedex';
         
    protected $fillable = ['user_id']; 
        
    public $timestamps = true;
        
        
    /**
     * The Inverse Of The Relationship
     * 
     * Pokedrex --- 1,1 ---- User
     */
     public function user()
    {
         return $this->belongsTo(User::class, 'user_id');
    }
    
    
    /** 
     *  Add PIVOT!
     *  Many to Many // hasMany?
     *  Pokedex --- 1,n ---- pokedex_pokem (N:M ) Pivot ---- 1,n ----Pokemon
     */
     public function pokemons()
    {
        return $this->hasMany(Custompoke::class);
            //withPivot('pokemon_id');
    }
        
        
      
   
}
