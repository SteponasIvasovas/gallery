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
    $galleryEntries = GalleryEntry::select('*', 'gallery_entries.id as galleryEntryId', 'users.id as userId')
    ->join('users', 'user_id', '=', 'users.id')
    ->where('title', 'like', '%'.$request->title.'%')
    ->paginate(10);
    $categories = Category::all();

    return view('home', compact('galleryEntries', 'categories'));
  }
  public function searchAdvanced(Request $request) {
    $categories = Category::all();
    $query = GalleryEntry::select('*', 'gallery_entries.id as galleryEntryId', 'users.id as userId')
    ->join('users', 'user_id', '=', 'users.id');

    if (isset($request->as_title_check)) {
      $query = $query->where('title', 'like', '%'.$request->as_title.'%');
    }

    if (isset($request->as_tags_check)) {
      $query = $query->where(function ($q) use ($request) {
        $tags = explode(" ", $request->as_tags);
        foreach($tags as $tag) {
          $q->orWhere('tags', 'like', '% '.$tag.' %');
        }
      });
    }

    if (isset($request->as_user_check)) {
      $query = $query->where('username', 'like', '%'.$request->as_user.'%');
    }

    if (isset($request->as_category_check)) {
      $query = $query->where(function ($q) use ($request) {
        foreach($request->as_category as $category) {
          $q->orWhere('category_id', '=', $category);
        }
      });
    }

    $galleryEntries = $query->paginate(10);
    // $galleryEntries = $this->paginate($galleryEntries, $perPage = 10, $page = null, $options = [], $path = 'searchAdvanced');
    return view('home', compact('galleryEntries', 'categories'));
  }

  public function filterCategory(Category $category) {
    $galleryEntries = GalleryEntry::select('*', 'gallery_entries.id as galleryEntryId', 'users.id as userId')
    ->join('users', 'user_id', '=', 'users.id')
    ->where('category_id', '=', $category->id)
    ->paginate(10);
    $categories = Category::all();

    return view('home', compact('galleryEntries', 'categories'));
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
