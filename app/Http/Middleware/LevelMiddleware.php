<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class LevelMiddleware
{
    /**
     * Sera responsabel por validar o nível do usuário sempre que houver uma requisição.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     public function handle($request, Closure $next, $level)
 {
     if(Auth::user()->level>=$level){
       return $next($request);
     }else{
         return redirect('/');
     }
 }
