<?php

namespace App\Http\Controllers;

use App\User;
use App\GalleryEntry;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(User $user) {
      $galleryEntries = GalleryEntry::where('user_id', '=', $user->id)->get();      
      return view('user.index', compact('user'), compact('galleryEntries'));
    }
}
