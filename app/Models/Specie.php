<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Pokemon;

class Specie extends Model
{
    use HasFactory, SoftDeletes;
    
     
    protected $table = 'specie';
             
    protected $fillable = ['name']; 
    
     public $timestamps = true;
     
    
       public function pokemon()
    {
         return $this->hasMany(Pokemon::class); //cambio
    }
    
    
    
    public static function boot()
    {
        parent::boot();
    
        static::deleted(function ($model) {
            $model->pokemon()->each(function ($item) {
                $item->delete();
            });
        });
    }
}
