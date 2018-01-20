<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function update(Request $request) {
      $comment = Comment::find($request->id);
      $comment->text = $request->text;
      $comment->update();
      echo json_encode($request->text);
      // dd($request);
    }
    public function delete(Request $request) {
      $comment = Comment::find($request->id);
      $comment->delete();
      echo json_encode("Delete successful");
    }
}
