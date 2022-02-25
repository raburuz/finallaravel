<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

//namespace
use App\Models\Type;
use App\Models\Specie;
use App\Models\Custompoke;
use App\Models\Image;


class Pokemon extends Model
{
    use HasFactory;
    use SoftDeletes;
    
     protected $table = 'pokemon';
         
     protected $fillable = ['name', 'image_id', 'type_id' , 'specie_id']; 
    
     public $timestamps = true;
     
     /** 
     *  The Inverse Of The Relationship
     *  Pokemon --- 1,1 ----> Type
     */
     public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }
    
    /** 
     * The Inverse Of The Relationship
     *  Pokemon --- 1,1 ----> Specie
     */
     public function specie()
    {
        return $this->belongsTo(Specie::class, 'specie_id');
    }
    
     /**
     * The Inverse Of The Relationship
     * 
     * Pokemon --- 1,1 ----> Image
     */
  
    
     /**
     * The Inverse Of The Relationship
     * 
     * Pokemon --- 1,1 ----> Image
     */
     public function custompoke()
    {
         return $this->hasMany(Custompoke::class); //cambio
    }
    
    
     /**
     * One To One (Polymorphic)
     * Get the pokemon image.
     */
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
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
