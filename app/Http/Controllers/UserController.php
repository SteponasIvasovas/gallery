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
      $galleryEntries = GalleryEntry::where('user_id', '=', $user->id)->get();
      return view('user.gallery', compact('user'), compact('galleryEntries'));
    }
    public function profile(User $user) {
      return view('user.profile', compact('user'));
    }
}
