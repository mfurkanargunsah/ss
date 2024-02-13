<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;


class SetPreferredLanguage
{
    public function handle(Request $request, Closure $next)
    {   
        $request->session()->start();
        $preferredLanguage = $request->session()->get('preferred_language');

        if ($preferredLanguage) {
            App::setLocale($preferredLanguage);
        } else {
            $acceptLanguages = $request->header('Accept-Language');
            $preferredLanguages = preg_split('/,\s*/', $acceptLanguages);

            foreach ($preferredLanguages as $language) {
                if (in_array($language, ['de', 'tr', 'en'])) {
                    $request->session()->put('preferred_language', $language);
                    App::setLocale($language);
                    break;
                }
            }

            if (!App::getLocale()) {
                $request->session()->put('preferred_language', 'tr');
                App::setLocale('tr');
            }
        }
        return $next($request);
    }
}