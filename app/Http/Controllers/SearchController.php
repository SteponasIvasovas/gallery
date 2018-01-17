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
}
