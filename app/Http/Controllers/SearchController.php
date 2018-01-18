<?php

namespace App\Http\Controllers;

use App\GalleryEntry;
use App\Category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchController extends Controller
{
  public function search(Request $request) {
    $galleryEntries = GalleryEntry::where('title', 'like', '%'.$request->title.'%')
                                    ->paginate(10);
    $users = User::all();
    $categories = Category::all();

    return view('home', compact('galleryEntries', 'users', 'categories'));
  }
  public function searchAdvanced(Request $request) {
    $users = User::all();
    $categories = Category::all();
    $galleryEntries = GalleryEntry::all();

    if (isset($request->as_title_check)) {
      $galleryEntries = $galleryEntries->intersect(GalleryEntry::where('title', 'like', '%'.$request->as_title.'%')->get());
    }

    if (isset($request->as_tags_check)) {
      $tags = explode(" ", $request->as_tags);

      $first = true;
      foreach($tags as $tag) {
        if ($first) {
          $first = false;
          $galleryEntries = $galleryEntries->intersect(GalleryEntry::where('tags', 'like', '% '.$tag.' %')->get());
        } else {
          $galleryEntries = $galleryEntries->merge(GalleryEntry::where('tags', 'like', '% '.$tag.' %')->get());
        }
      }
    }

    if (isset($request->as_user_check)) {
      $galleryEntries = $galleryEntries->intersect(GalleryEntry::join('users', 'user_id', '=', 'users.id')
      ->where('users.username', 'like', '%'.$request->as_user.'%')->get());
    }

    if (isset($request->as_category_check)) {
      $first = true;
      foreach($request->as_category as $category) {
        if ($first) {
          $first = false;
          $galleryEntries = $galleryEntries->intersect(GalleryEntry::where('category_id', '=', $category)->get());
        } else {
          $galleryEntries = $galleryEntries->merge(GalleryEntry::where('category_id', '=', $category)->get());
        }
      }
    }

    $galleryEntries = $this->paginate($galleryEntries, $perPage = 10, $page = null, $options = [], $path = 'searchAdvanced');
    return view('home', compact('galleryEntries', 'users', 'categories'));
  }

  public function paginate($items, $perPage = 15, $page = null, $options = [], $path = "")
  {
  	$page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
  	$items = $items instanceof Collection ? $items : Collection::make($items);
  	$paginator =  new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    $paginator->setPath($path);
    return $paginator;
  }
}
