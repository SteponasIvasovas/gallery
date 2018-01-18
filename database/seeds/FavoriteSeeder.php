<?php

use App\User;
use App\GalleryEntry;
use App\Favorite;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class FavoriteSeeder extends Seeder
{
  protected $favorite;
  protected $faker;
  protected $user;
  protected $galleryEntry;
  public function __construct(favorite $favorite, User $user, GalleryEntry $galleryEntry, Faker $faker) {
    $this->favorite = $favorite;
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
      $favorites = [];
      $faker = $this->faker->create();
      $user_ids = $this->user->pluck('id');
      $galleryEntries_ids = $this->galleryEntry->pluck('id');
      foreach (range(1, 100) as $x) {
        $unique = false;

        while(!$unique) {
          $user_id = $user_ids->random();
          $galleryEntry_id = $galleryEntries_ids->random();

          if (!in_array($user_id." ".$galleryEntry_id, $favorites)) {
            array_push($favorites, $user_id." ".$galleryEntry_id);
            $unique = true;
            $this->favorite->create([
              'user_id' => $user_id,
              'gallery_entry_id' => $galleryEntry_id,

              'created_at' => new \DateTime(),
              'updated_at' => new \DateTime(),
            ]);
          }
        }
      }
  }
}
