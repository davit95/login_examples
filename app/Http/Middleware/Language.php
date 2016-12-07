<?php

namespace App\Http\Middleware;

use Closure;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $array = ['an', 'ru', 'am'];
    public function handle($request, Closure $next)
    {
        $array = ['an', 'ru', 'am'];
        $lang = env('DEFAULT_LANGUAGE', 'am');
        $lang = \Request::segment(2);
        if(!in_array($lang,$array)) {
            $lang = 'en';
        }
        app()->setLocale($lang);
        //dd($lang);
        view()->share('title', 'title_' . $lang);
        view()->share('lang',  $lang);
        return $next($request);
    }
}
