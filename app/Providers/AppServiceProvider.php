<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\GalleryEntry;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      // if (!GalleryEntry::hasMacro('paginate')) {
      //         GalleryEntry::macro('paginate',
      //             function ($perPage = 15, $page = null, $options = []) {
      //             $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
      //             return (new LengthAwarePaginator(
      //                 $this->forPage($page, $perPage), $this->count(), $perPage, $page, $options))
      //                 ->withPath('');
      //         });
      // }
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
