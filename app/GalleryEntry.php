<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GalleryEntry extends Model
{
    protected $fillable = [
      'title',
      'description',
      'image',
      'tags',
      'category',
    ];

    public function user() {
      return $this->belongsTo(User::class);
    }
}
