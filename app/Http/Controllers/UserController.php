<?php

namespace App\Http\Controllers;

use App\User;
use App\GalleryEntry;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(User $user) {
    }
    public function gallery(User $user) {
      $galleryEntries = GalleryEntry::select('*', 'gallery_entries.id as gallery_entry_id', 'users.id as user_id')
      ->join('users', 'user_id', '=', 'users.id')
      ->where('user_id', '=', $user->id)
      ->orderBy('gallery_entries.created_at')
      ->paginate(12);
      return view('user.gallery', compact('user', 'galleryEntries'));
    }
    public function profile(User $user) {
      return view('user.profile', compact('user'));
    }
}
