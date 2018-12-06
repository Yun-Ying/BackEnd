<?php

    use App\User;
    use Faker\Factory;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\Hash;

    class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //reset user
        // User::truncate();


        $faker = Factory::create();
        $total = 20;


        foreach (range(1, $total) as $i) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => Hash::make('111111'),
                'exp' => 0,
                'created_at' => now()->subDays($total - $i)->addHours(rand(1, 5))->addMinutes(rand(1, 5))->subDays(rand(5, 20))->subMonths(rand(0, 12)),
                'updated_at' => now()->subDays($total - $i)->addHours(rand(6, 10))->addMinutes(rand(10, 30))->subDays(rand(6, 12))->subMonths(rand(0, 12)),
            ]);
        }

    }
}
