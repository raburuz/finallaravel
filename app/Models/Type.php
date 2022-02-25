<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


//namespace
use App\Models\Pokemon;

class Type extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'type';
             
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
