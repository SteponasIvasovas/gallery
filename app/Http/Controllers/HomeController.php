<?php

namespace App\Http\Controllers;

use App\User;
use App\GalleryEntry;
use App\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //Patikrina ar vartotojas prisijunges, jei neprisijunges uzkrauna logina
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $galleryEntries = GalleryEntry::paginate(10);
      $users = User::all();
      $categories = Category::all();
      return view('home', compact('galleryEntries', 'users', 'categories'));
    }
}
