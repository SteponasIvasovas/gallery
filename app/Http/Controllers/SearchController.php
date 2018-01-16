<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\GalleryEntry;

class SearchController extends Controller
{
  public function search(Request $request) {
    $galleryEntries = GalleryEntry::where('title', 'like', '%'.$request->title.'%')
                                    ->paginate(10);
    $users = User::all();
    return view('home', compact('galleryEntries'), compact('users'));
  }
}
