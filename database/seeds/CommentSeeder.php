<?php

use App\User;
use App\GalleryEntry;
use App\Comment;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    protected $comment;
    protected $faker;
    protected $user;
    protected $galleryEntry;
    public function __construct(Comment $comment, User $user, GalleryEntry $galleryEntry, Faker $faker) {
      $this->comment = $comment;
      $this->user = $user;
      $this->galleryEntry = $galleryEntry;
      $this->faker = $faker;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = $this->faker->create();
        $user_ids = $this->user->pluck('id');
        $galleryEntries_ids = $this->galleryEntry->pluck('id');
        foreach (range(1, 100) as $x) {
          $this->comment->create([
            'user_id' => $user_ids->random(),
            'gallery_entry_id' => $galleryEntries_ids->random(),
            'text' => $faker->text(1000),

            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime(),
          ]);
        }
    }
}
