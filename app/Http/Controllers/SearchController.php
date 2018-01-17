<?php

namespace App\Http\Controllers;

use App\GalleryEntry;
use App\Category;
use App\User;
use Illuminate\Http\Request;

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
    // dd($galleryEntries);

    if (isset($request->as_title_check)) {
      $galleryEntries = $galleryEntries->intersect(GalleryEntry::where('title', 'like', '%'.$request->as_title.'%')->get());
    }

    if (isset($request->as_tags_check)) {
      $tags = explode(" ", $request->as_tags);

      foreach($tags as $tag) {
        $galleryEntries = $galleryEntries->intersect(GalleryEntry::where('tags', 'like', '% '.$tag.' %')->get());
      }
    }

    if (isset($request->as_user_check)) {
      $galleryEntries = $galleryEntries->intersect(GalleryEntry::join('users', 'user_id', '=', 'users.id')
      ->where('users.username', 'like', '%'.$request->as_user.'%')->get());
    }

    if (isset($request->as_category_check)) {
      foreach($request->as_category as $category) {
        $galleryEntries = $galleryEntries->intersect(GalleryEntry::where('category_id', '=', $category)->get());
      }
    }

    // $galleryEntries = $galleryEntries->paginate(10);

    return view('home', compact('galleryEntries', 'users', 'categories'));
  }
}
