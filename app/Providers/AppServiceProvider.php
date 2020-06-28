<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        /**
         * Blade directive for images
         */
        Blade::directive('voyager_image', static function ($image) {
            return "<?php echo filter_var($image, FILTER_VALIDATE_URL) ? $image : Voyager::image($image); ?>";
        });

        /**
         * Blade directive for reading svg images as string
         */
        Blade::directive('get_cleaned_uri', static function () {
            return '<?php echo Localizer::getCleanedUri(); ?>';
        });

        /**
         * Blade directive for getting url to storage
         */
        Blade::directive('storage_url', static function ($uri) {
            return "<?php echo asset('storage/$uri'); ?>";
        });


        /**
         * Blade directive for displaying post date
         */
        Blade::directive('reformat_date', static function ($date) {
            $datetime = new Carbon($date);
            $locale = config('app.locale');
            $datetime->locale($locale);
            return "<?php echo $datetime->day . ' ' . $datetime->monthName . ', ' . $datetime->year; ?>";
        });


    }
}
