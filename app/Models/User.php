<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\GetData;
use App\Traits\Paginate;

//namespace from Pokedex and Eloquent
use Illuminate\Database\Eloquent\Model;
use App\Models\Pokedex;
use App\Models\Image;
use App\Models\Custompoke;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, GetData, Paginate;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'rol',
        'image_id',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    
    /**
    * One to One Relationship
    * User call to Pokedrex
    * User --- 1,1 ---- Pokedrex
    */
    public function pokedex()
    {
        return $this->hasOne(Pokedex::class);
    }
    
  
   
   /**
     * Has Many Through
     * 
     * User ---> Pokedex ---> CustomPoke (target)
     */
    public function Custompokes()
    {
        return $this->hasManyThrough(Custompoke::class, Pokedex::class);
    }
    
    
    /**
    * One To One (Polymorphic)
    * Get the user's image.
    */
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    
    
  
   
}
