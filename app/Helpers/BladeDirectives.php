<?php

use TCG\Voyager\Facades\Voyager;
use App\Helpers\Localizer;





if (!\function_exists('voyager_image')) {

    /**
     * Returns localized url.
     *
     * @param mixed $image image path
     * @return mixed image URL
     */
    function voyager_image($image)
    {
        return filter_var($image, FILTER_VALIDATE_URL) ? $image : Voyager::image($image);
    }
}



if(!\function_exists('get_cleaned_uri')) {

    /**
     * @return bool|string|null
     */
    function get_cleaned_uri()
    {
        return Localizer::getCleanedUri();
    }
}



if(!\function_exists('storage_url')) {

    /**
     * @param $uri
     * @return string
     */
    function storage_url($uri)
    {
        return asset('storage/' . $uri);
    }
}




