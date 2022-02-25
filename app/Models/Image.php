<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//Trait
use App\Traits\ImageTrait;

use App\Models\Image;
class Image extends Model
{
    use HasFactory, ImageTrait;
    
    protected $table = 'image';
         
    protected $fillable = ['file_name', 'upload_name', 'mimetype', 'imageable_id', 'imageable_type']; 
    
    public $timestamps = true;
    
    
    /**
    * One To One (Polymorphic)
    * 
    * Get the parent imageable model (user or pokemon).
    */
    
     public function imageable()
    {
        return $this->morphTo();
    }
    
   
    
}
