<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    public function galleryEntries() {
      return $this->belongsTo(GalleryEntry::class);
    }
    public function users() {
      return $this->belongsTo(User::class);
    }
}
