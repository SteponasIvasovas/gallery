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
        $this->user->create([
        'username' => $faker->name(),
        'email' => $faker->email(),
        'password' => \Hash::make('testas'),
        'admin' => 0,
        'created_at' => new \DateTime(),
        'updated_at' => new \DateTime(),
       ]);
      }
    }
}
