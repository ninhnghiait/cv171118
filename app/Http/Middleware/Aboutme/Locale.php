<?php

namespace App\Http\Middleware\Aboutme;
use Illuminate\Support\Facades\Session;
use Closure;
use Illuminate\Support\Facades\Lang;

class Locale
{
    public function handle($request, Closure $next)
    {
        if (!Session::has('locale')) {
            Session::put('locale', config('app.locale'));
        }

        Lang::setLocale(Session::get('locale'));

        return $next($request);
    }
}