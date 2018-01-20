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
      // view()->composer('gallery-entry.show', function($view) use(){
      //   $userComments = \App\User::select('*', 'comments.id as comment_id')
      //   ->join('comments', 'users.id', '=', 'comments.user_id')
      //   ->where('comments.gallery_entry_id', '=', $galleryEntry->id)
      //   ->orderBy('comments.created_at')
      //   ->get();
      //   $tags = explode(' ', $galleryEntry->tags);
      //   $galleryEntry = \App\GalleryEntry::select('*', 'gallery_entries.id as gallery_entry_id')
      //   ->join('users', 'user_id', '=', 'users.id')
      //   ->where('gallery_entries.id', '=', $galleryEntry->id)
      //   ->first();
      //   $view->with(compact('galleryEntry', 'userComments', 'tags'));
      // });
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
