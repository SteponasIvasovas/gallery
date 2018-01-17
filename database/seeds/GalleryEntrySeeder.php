<?php
use App\User;
use App\GalleryEntry;
use App\Category;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class GalleryEntrySeeder extends Seeder
{
	  protected $galleryEntry;
    protected $faker;
    protected $user;
		protected $category;
    public function __construct(Faker $faker, GalleryEntry $galleryEntry, User $user, Category $category) {
	    $this->galleryEntry = $galleryEntry;
	    $this->faker = $faker;
	    $this->user = $user;
			$this->category = $category;
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
			$category_ids = $this->category->pluck('id');
      foreach (range(1, 40) as $x) {
				$width = 50 * rand(1, 20);
				$height = 50 * rand(1, 20);
        $this->galleryEntry->create([
        'user_id' => $user_ids->random(),
				'category_id' => $category_ids->random(),
        'title' => $faker->word(),
        'description' => $faker->text(200),
        'image' => $faker->imageUrl($width, $height),
        'tags' => $faker->words(rand(0, 5), true),

        'created_at' => new \DateTime(),
        'updated_at' => new \DateTime(),
       ]);
      }
    }
}
