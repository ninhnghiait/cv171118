<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Schema;
use App\Model\Myinfo\MIFQuotations;
use App\Model\Myinfo\MIFintro;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Model\News\NECat;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    view()->composer('*', function ($view)
        {
            
        Schema::defaultStringLength(191);
        //
        $lang = \Session::get('locale');
        if(is_null($lang)) {$lang = 'en';} 
        $objmQuotations = new MIFQuotations();
        $objItemsQuotations = $objmQuotations->getRandomItem($lang);
        View::share('objItemsQuotations',$objItemsQuotations);

        $publicUrl = getenv('PUBLIC_URL');
        View::share('publicUrl',$publicUrl);
        //
        
        $objmMIFintro = new MIFintro();
        $objItemIntro = $objmMIFintro->getFirstItem($lang);
        View::share('objItemIntro',$objItemIntro);
        });
        $objmNECat = new NECat();
        $objItemsCat = $objmNECat->getItemsAll();
        View::share('objItemsCat',$objItemsCat);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
