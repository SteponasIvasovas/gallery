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
    public function categories() {
      return $this->hasMany(Category::class);
    }
    public function comments() {
      return $this->hasMany(Comment::class);
    }
    public function favorites() {
      return $this->hasMany(Favorite::class);
    }
}
