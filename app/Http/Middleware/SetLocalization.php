<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetLocalization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $url_locale = $request->segment(1);
        $app_locale = config('app.locale');
        $default_locale = config('app.default_locale');
        $available_locales = config('app.available_locales');

        if($url_locale && $url_locale !== $app_locale && in_array($url_locale, $available_locales, false)){
            App::setLocale($url_locale);
            return $next($request);
        }

        return redirect('/' . $default_locale . '/');
    }
}
