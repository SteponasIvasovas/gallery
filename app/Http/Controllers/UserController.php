<?php

namespace App\Http\Controllers;

use DateTime;
use Auth;
use App\User;
use App\GalleryEntry;
use App\Favorite;
use Illuminate\Support\Facades\Storage;
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

      return view('user.favorites', compact('user', 'favorites'));
    }

    public function profile(User $user) {
      return view('user.profile', compact('user'));
    }
    public function update(Request $request) {
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

      $user->about = $request->about;
      $user->update();
      echo json_encode($request);
    }
    public function avatarUpdate(Request $request) {
      $user = User::find(Auth::user()->id);
      $name = $request->file('image')->getClientOriginalName();
      $path = 'public/images/'.Auth::user()->id.'/';
      $date = new DateTime();
      $request->file('image')->storeAs($path, $date->getTimestamp().$name);
      $user->avatar = $path.$date->getTimestamp().$name;
      $user->update();
      return redirect('user/'.Auth::user()->id);
    }
}
