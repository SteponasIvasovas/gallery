<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\GalleryEntry;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
  public function add(Request $request) {
    // $galleryEntry = GalleryEntry::find($request->id);
    $favorite = new Favorite();
    $favorite->user_id = $request->user_id;
    $favorite->gallery_entry_id = $request->gallery_entry_id;
    $favorite->save();
    echo json_encode("Favorite successful");
  }
  public function remove(Request $request) {
    // $galleryEntry = GalleryEntry::find($request->id);
    $favorite = Favorite::where('user_id', $request->user_id)
    ->where('gallery_entry_id', $request->gallery_entry_id)->get();
    $favorite->delete();
    echo json_encode("Delete successful");
  }
}
