<?php


namespace App\Helpers;


use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;

/**
 * Class Localizer
 * @package App\Helpers
 */
class Localizer
{
    /**
     * @return string|null
     */
    protected static function getUrlLocale(): ?string
    {
        return Request::segment(1);
    }


    /**
     * @return array
     */
    protected static function getLocalizationSettings(): array
    {
        return [
            'app_locale' => config('app.locale'),
            'available_locales' => config('app.available_locales')
        ];
    }


    /**
     * @return string
     */
    public static function getLocalizationPrefix(): string
    {
        $url_locale = static::getUrlLocale();
        $settings = static::getLocalizationSettings();

        if ($url_locale && $url_locale !== $settings['app_locale'] && in_array($url_locale, $settings['available_locales'], false)) {
            App::setLocale($url_locale);
            return $url_locale;
        }

        return $settings['app_locale'];
    }

    /**
     * @param string $locale
     * @param bool $forHeader
     * @return string
     */
    public static function getRequestUrlByLocale(string $locale, bool $forHeader = false): string
    {
        $segments = request()->segments();
        $supportedLocales = config('app.available_locales');

        if (!empty($segments) && in_array($segments[0], $supportedLocales)) {
            $segments[0] = $locale;
        } else {
            array_unshift($segments, $locale);
        }

        $url = '/' . implode('/', $segments);

        // Append query string if present
        $query = request()->getQueryString();
        if ($query) {
            $url .= '?' . $query;
        }

        return $forHeader ? env('APP_URL') . $url : $url;
    }


    /**
     * @return bool|string|null
     */
    public static function getCleanedUri()
    {
        $url_locale = static::getUrlLocale();
        $uri = Request::path();
        $uri_parts = explode('/', $uri);

        if(!$url_locale){
            return $uri;
        } else if(in_array($url_locale, $uri_parts, false)) {
            return mb_substr($uri, (strlen($url_locale) + 1));
        }
        abort(404);
    }
}
