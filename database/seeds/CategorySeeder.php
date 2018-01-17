<?php

use Illuminate\Database\Seeder;
use App\Category;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
{
    protected $category;
    protected $faker;
    public function __construct(Category $category, Faker $faker) {
      $this->category = $category;
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
      foreach (range(1, 3) as $x) {
        $this->category->create([
          'name' => $faker->unique()->randomElement(array('people', 'cars', 'animals', 'cats', 'dogs')),

          'created_at' => new \DateTime(),
          'updated_at' => new \DateTime(),
        ]);
      }
    }
}
