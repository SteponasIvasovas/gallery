<?php

namespace App\Http\Controllers;

use Auth;
use App\Comment;
use App\GalleryEntry;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function post(Request $request) {
      // dd($request);
      $comment = new Comment();
      $comment->text = $request->text;
      $comment->gallery_entry_id = $request->gallery_entry_id;
      $comment->user_id = Auth::user()->id;
      // Auth::user()->comments()->save($comment);
      $comment->save();

      $galleryEntry = GalleryEntry::find($request->gallery_entry_id);

      return redirect('gallery-entry/'.$request->gallery_entry_id);
    }
    public function update(Request $request) {
      $comment = Comment::find($request->id);
      $comment->text = $request->text;
      $comment->update();
      echo json_encode($request->text);
    }
    public function delete(Request $request) {
      $comment = Comment::find($request->id);
      $comment->delete();
      echo json_encode("Delete successful");
    }
}
