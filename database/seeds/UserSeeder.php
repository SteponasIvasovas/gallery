<?php
use App\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
	  protected $user;
    protected $faker;
    public function __construct(User $user, Faker $faker) {
        $this->user = $user;
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
      foreach (range(1, 10) as $x) {
				$width = 50 * rand(1, 20);
				$height = 50 * rand(1, 20);
        $this->user->create([
        'username' => $faker->unique()->userName(),
        'email' => $faker->unique()->email(),
        'password' => \Hash::make('testas'),
				'admin' => 0,

				'gender' => $faker->randomElement(array ('male','female')),
				'firstname' => $faker->firstName(),
				'lastname' => $faker->lastName(),
				'birthday' => $faker->dateTimeThisCentury->format('Y-m-d'),
				'country' => $faker->country(),
				'city' => $faker->city(),
				'avatar' => $faker->imageUrl($width, $height),
				'tagline' => $faker->text(100),
				'about' => $faker->text(2000),

        'created_at' => new \DateTime(),
        'updated_at' => new \DateTime(),
       ]);
      }
    }
}
