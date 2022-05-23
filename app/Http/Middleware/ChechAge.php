<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use App\Http\Middleware\ChechAge;
use Auth;
class ChechAge
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
        /*

        $age =Auth::user() -> age;
        if($age < 15){
            return redirect() -> route('not.adult');
        }
        return $next($request);
        */
  

      
      // Auth::user()  ///*---> بتجيب بيانات كل اليوزلر للي داخل
      $age=Auth::user() ->age;
      
      //logic of middleware
        if($age <15)
        {
           
            return redirect()->route('not.adult');
        }
        return $next($request);
        //return redirect()->route('adult');
    
    
}
}