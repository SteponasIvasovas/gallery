<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\GalleryEntry;
use App\Favorite;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(User $user) {
    }
    public function gallery(User $user) {
      $galleryEntries = GalleryEntry::select('*', 'gallery_entries.id as galleryEntryId', 'users.id as userId')
      ->join('users', 'user_id', '=', 'users.id')
      ->where('user_id', '=', $user->id)
      ->orderBy('gallery_entries.created_at')
      ->paginate(12);
      return view('user.gallery', compact('user', 'galleryEntries'));
    }
    public function favorites(User $user) {
      $favorites = Favorite::select('*', 'gallery_entries.id as galleryEntryId',
      'users.id as userId', 'gallery_entries.user_id as galleryEntryUserId',
      'favorites.id as favoriteId')
      ->join('users', 'user_id', '=', 'users.id')
      ->join('gallery_entries', 'gallery_entry_id', '=', 'gallery_entries.id')
      ->where('favorites.user_id', $user->id)
      ->paginate(12);

      // dd($favorites);

      return view('user.favorites', compact('user', 'favorites'));
    }

    public function profile(User $user) {
      return view('user.profile', compact('user'));
    }
    public function update(Request $request) {
      // tagline : $(tagline).val()
      // firstname : $(firstname).val(),
      // lastname : $(lastname).val(),
      // birthday : $(birthday).val(),
      // country : $(country).val(),
      // city : $(city).val(),
      // gender : $(gender).val(),
      // about : $(about).val()
      $user = User::find(Auth::user()->id);
      $user->firstname = $request->firstname;
      $user->lastname = $request->lastname;
      $user->gender = $request->gender;
      $user->birthday = $request->birthday;
      $user->country = $request->country;
      $user->city = $request->city;

      if ($request->tagline == "null") {
        $user->tagline = null;
      }
      else {
        $user->tagline = $request->tagline;
      }

      // $name = $request->file('avatar')->getClientOriginalName();

      $user->about = $request->about;
      $user->update();
      echo json_encode($request);
    }
}
