<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Skill
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
        
        $id=Str::of(\Request::getPathInfo())->afterLast('/');
        $skill=Str::of(\Request::getPathInfo())->between('/', '/');
        
        $request->merge(['skin_id'=>$id, "skill"=>$skill ]);
        
      
        return $next($request);
    }
}
