<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
      'text'
    ];

    public function galleryEntry() {
      return $this->belongsTo(GalleryEntry::class);
    }
    public function users() {
      return $this->belongsTo(User::class);
    }
}
