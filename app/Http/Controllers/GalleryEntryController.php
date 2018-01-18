<?php


namespace App\Http\Controllers;

use DateTime;
use App\User;
use App\GalleryEntry;
use App\Comment;
use App\Http\Requests\StoreGalleryEntryRequest;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Input;
// use Intervention\Image\Facades\Image;

class GalleryEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleryEntries = GalleryEntry::all();
        $users = User::all();
        return view('gallery-entry.index', compact('galleryEntries', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('gallery-entry.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGalleryEntryRequest $request)
    {
      $galleryEntry = new GalleryEntry();

      $galleryEntry->title = $request->title;
      $galleryEntry->description = $request->description;
      $galleryEntry->tags = $request->tags;

      $name = $request->file('image')->getClientOriginalName();
      $date = new DateTime();
      $request->file('image')->storeAs('public/images', $date->getTimestamp().$name);
      $galleryEntry->image = $date->getTimestamp().$name;

      Auth::user()->galleryEntries()->save($galleryEntry);
      return redirect('/')->with(['message' => 'Gallery entry successfully submitted']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GalleryEntry  $galleryEntry
     * @return \Illuminate\Http\Response
     */
    public function show(GalleryEntry $galleryEntry)
    {
      // $users = User::distinct()->join('comments', 'users.id', '=', 'comments.user_id')->get();
      $users = DB::table('users')
      ->join('comments', 'users.id', '=', 'comments.user_id')
      ->groupBy('id')
      ->get();
                     // join('gallery_entries', 'gallery_entries.id', '=', 'comments.gallery_entry_id' )->get();

      dd($users);
      $comments = Comment::join('gallery_entries', 'gallery_entry_id', '=', 'gallery_entries.id')->get();

      return view('gallery-entry.show', compact('galleryEntry', 'users', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GalleryEntry  $galleryEntry
     * @return \Illuminate\Http\Response
     */
    public function edit(GalleryEntry $galleryEntry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GalleryEntry  $galleryEntry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GalleryEntry $galleryEntry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GalleryEntry  $galleryEntry
     * @return \Illuminate\Http\Response
     */
    public function destroy(GalleryEntry $galleryEntry)
    {
        //
    }
}
