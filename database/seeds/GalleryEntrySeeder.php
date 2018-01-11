<?php
use App\User;
use App\GalleryEntry;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class GalleryEntrySeeder extends Seeder
{
	  protected $galleryEntry;
    protected $faker;
    protected $user;
    public function __construct(GalleryEntry $galleryEntry, Faker $faker, User $user) {
        $this->galleryEntry = $galleryEntry;
        $this->faker = $faker;
        $this->user = $user;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $width = 800;
      $height = 600;
      $faker = $this->faker->create();
      $user_ids = $this->user->pluck('id');
      foreach (range(1, 10) as $x) {
        $this->galleryEntry->create([
        'user_id' => $user_ids->random(),
        'title' => $faker->word(),
        'description' => $faker->text(200),
        'image' => $faker->imageUrl($width, $height, 'cats'),
        'tags' => $faker->words(rand(0, 5), true),
        'favorite_count' => 0,
        'comment_count' => 0,
        'created_at' => new \DateTime(),
        'updated_at' => new \DateTime(),
       ]);
      }
    }
}
