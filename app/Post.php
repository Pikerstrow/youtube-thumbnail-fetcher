<?php

namespace App;

use Carbon\Carbon;


class Post extends \TCG\Voyager\Models\Post
{
    public function getCreatedAtAttribute($value)
    {
        $datetime = new Carbon($value);
        $locale = config('app.locale');
        $datetime->locale($locale);
        return $datetime->day . ' ' . $datetime->monthName . ', ' . $datetime->year;
    }
}
