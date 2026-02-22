<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        $supported = array_keys(config('app.available_locales', []));

        $locale = $request->query('locale');

        if (!$locale) {
            $locale = $request->session()->get('locale', config('app.locale'));
        }

        if (!in_array($locale, $supported, true)) {
            $locale = config('app.locale');
        }

        App::setLocale($locale);
        $request->session()->put('locale', $locale);

        return $next($request);
    }
}
