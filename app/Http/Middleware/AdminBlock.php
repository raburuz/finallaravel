<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;

class AdminBlock
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
        $currentRole=Auth()->user()->rol;
        $currentID=Auth()->user()->id;
        $userId=Str::of(\Request::getPathInfo())->afterLast('/');
        
        //Rutes end with id
        if(is_numeric((string)$userId)){
             $user=User::find($userId);
         
       //Rutes dont end with id,example like url/6/edit
        } else{
            $userId=Str::of(\Request::getPathInfo())->beforeLast('/');
            $userId=Str::of($userId)->afterLast('/');
            $user=User::find($userId);
        }
        
        
        if( $currentRole == 'admin' && ($currentRole == $user->rol && $user->id != $currentID) ){
            return redirect('home');    
        }
 
        return $next($request);
    }
}
