<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
class SetAppLocale
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
    //     $defalut='en';
    //     $language=$request->header('accept-language');
    //    if($language){
    //        $options=explode(',',$language);
    //      $defalut=$options[0];
    //      if(strlen($defalut)==5){
    //          $defalut=substr($defalut,0,2);
    //      }
    //    }
    //     $lang=$request->input('lang',Session::get('locale',$defalut));
    //     App::setLocale($lang);
    //     Session::put('locale',$lang);
    $locale=$request->route('locale','en');
    URL::defaults([
        'locale' => $locale,
    ]);
    Route::current()->forgetParameter('locale');
    App::setLocale($locale);

        return $next($request);
    }
}
