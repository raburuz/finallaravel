<?php

namespace App\Traits;

//namespace
use App\Models\Image;

trait ImageTrait
{
    
     /**
     * Upload Image in storage
     *
     * @param array $file  [hasFile:boolean, file:File]
     * @param array $imageData Image Data  
     * @return boolean 
     */
    public function isUploadImageToStorage($file=[]){
        
        $hasFile        = $file['hasFile'];
        $fileUploaded   = $file['file'];
        $fileName       = $file['name'];
        
        if($hasFile && $fileUploaded->isValid()) {
         
            $fileUploaded->storeAs('public/img', $fileName);
            
            return true;
        }
        
        return false;
    
    }
    
     /**
     * Save Image in Database
     * 
     * @param array $file ImageFile and data
     */
    public function saveImageInDataBase($file=[]){
        
        $data['file_name']      = $file['name'];
        $data['upload_name']    = $file['file']->getClientOriginalName();
        $data['mimetype']       = $file['file']->extension();
        $data['imageable_id']   = $file['imageable_id'];
        $data['imageable_type'] = $file['imageable_type'];
    
       try{
           $image = new Image($data);
           $image->save();
       }
       catch(\Exception $e){
                    
           return back()->withInput();
        }
    
    }
    
    
    /**
     * Update Image in Database
     * 
     * @param array $image Image for update
     * @param array $file  New Data
     */
    public function updateImageInDataBase($image, $file){
        
        $data['file_name']      = $file['name'];
        $data['upload_name']    = $file['file']->getClientOriginalName();
        $data['mimetype']       = $file['file']->extension();
        $data['imageable_id']   = $file['imageable_id'];
        $data['imageable_type'] = $file['imageable_type'];
       try{
         
           $image->update($data);
           $image->save();
       }
       catch(\Exception $e){
                   
           return back()->withInput();
        }
    
    }
    
    /**
     * Get Type Image 
     * 
     * @param string $imageableType image Type can be user and admin
     * 
     * @return type 
     */
    private function getImageableType($imageableType){
        return ($imageableType==='user')? 'App\Models\User' : 'App\Models\Pokemon';
    }
    
    /**
     * Delete Image from storage and database
     * 
     * @param object $image  Data Image
     * 
     */
    public function deleteImageFromStorage($image){
       
        $image_path = './storage/img/' . $image->file_name;
       
      
        if(file_exists($image_path)){
            unlink($image_path);
        }

    }
    
    
    public function getDataFromImage($request){
        //capture img and hashname
        $file['hasFile']=$request->hasFile('avatar');
        $file['file']=$request->file('avatar');
        $file['name']=$request->file('avatar')->hashName();
       
        //Is poke or user img
        $file['imageable_id'] = $request->input('imageable_id');
        $file['imageable_type'] = self::getImageableType($request->input('imageable_type'));
        
        return $file;
    }
    
    
}