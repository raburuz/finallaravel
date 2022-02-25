<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


//request
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
      
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware('admin')->except(['edit','update']); //ok
        
        $this->middleware('Userblocked')->only(['edit']);
        
        $this->middleware('redirect')->only(['index', 'create','store']);
        
        $this->middleware('blocked')->only(['edit']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $data['user']=$user;
        $data['haveImage'] = ($user->image) ? true : false;
        return view('user.show', $data );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $admins = User::where('rol', '=', 'admin')->get();
        $data['numAdmins']=$admins->count();
        $data['roles']=User::roles();
        $data['isNormalUser']= Auth()->user()->rol == 'user' && true;
        $data['user']=$user;
        return view('user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
         dd('dsdfasds');
        if (!$this->isCorrectPassword($request->input('password2'), $user->password)) {
             return back()->withInput(
                $request->except('password2')
            );
        }
        
     
        if($request->input('password')){
            $dataForUpdate['password']=$this->hashNewPassword($request->input('password'));
        }
        
        $dataForUpdate['name'] =$request->input('name');
        $dataForUpdate['email']=$request->input('email');
        
        
         try{
             $user->update($dataForUpdate);
             $user->save();
         }
         catch(\Exception $e){
             return back()->withInput();
         }
         return redirect('home');
    }
    
    
    /**
     * Show the form for editing the specified user by admin.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function editUser(User $user)
    {
        
      
        $admins = User::where('rol', '=', 'admin')->get();
        $data['user']=$user;
        $data['roles']=User::roles();
        $data['isVerified']=$this->isVerifiedUser($user->email_verified_at);
        return view('user.editUser', $data);
    }
    
    /**
     * Update the specified user by admin
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function updateUser(UserUpdateRequest $request, User $user)
    {
        
        if (!$this->isCorrectPassword($request->input('password2'), Auth()->user()->password)) {
             return back()->withInput(
                $request->except('password2')
            );
        }
        
        if($request->input('password')){
            $dataForUpdate['password']=$this->hashNewPassword($request->input('password'));
        }
        $dataForUpdate['email_verified_at']=$this->isVerifiedUser($request->input('email_verified_at'));
        $dataForUpdate['rol'] =$request->input('rol');
        
        if($dataForUpdate['rol'] == 'admin'){
             $dataForUpdate['email_verified_at']=$this->isVerifiedUser(true);
        }
        
        $dataForUpdate['name'] =$request->input('name');
        $dataForUpdate['email']=$request->input('email');
        
        
         try{
             $user->update($dataForUpdate);
             $user->save();
         }
         catch(\Exception $e){
             return back()->withInput();
         }
         return redirect('home');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try{
            $user->delete();
        }
        catch(\Exception $e){
           return redirect('home');
        }
        return redirect('home');
    }
    
    
    /**
     * Hash new password 
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User  $user
     * 
     * @return view
     */
    private function hashNewPassword($newPassword)
    {
        return Hash::make($newPassword);
        
    }
    
    /**
     * Check if is correct password
     *
     * @param  string  $inputPassword
     * @param  string  $currentPasswd
     * @param  string  $view
     * 
     * @return boolean 
     */
    private function isCorrectPassword( $inputPassword, $currentPasswd ){
        if (!Hash::check($inputPassword, $currentPasswd)) {
             return false;
        }
        return true;
    }
    
    /**
     * Check if user is verified
     *
     * @param  boolean  $verified
     * 
     * @return Date|Null 
     */
    private function isVerifiedUser($verified){
        return $verified != null ? $this->getCurrentTime() : null;
    }
    
    private function getCurrentTime(){
        return now()->toDateTimeString();
    }
    
    
}
