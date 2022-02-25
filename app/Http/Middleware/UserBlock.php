<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;

class UserBlock
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        
        $role=Auth()->user()->rol;
        $id=Auth()->user()->id;
        $userId=Str::of(\Request::getPathInfo())->beforeLast('/');
        $userId=Str::of($userId)->afterLast('/');
        $user=User::find($userId);
        
       //dd($id, $userId ,$user);
        if(($role == 'user' || $role == 'admin') && ($id == $user->id )){
            
             return $next($request);
        }
     
        return redirect('home');
       
    }
}
