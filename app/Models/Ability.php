<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Custompoke;

class Ability extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'ability';
             
    protected $fillable = ['name']; 
    
    public $timestamps = true;
    
    
    
       public function custompoke()
    {
         return $this->hasMany(Custompoke::class); //cambio
    }
    
    
     public static function boot()
    {
        parent::boot();
    
        static::deleted(function ($model) {
            $model->custompoke()->each(function ($item) {
                $item->delete();
            });
        });
    }
}
