<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory()->count(5)->create();

        $users->take(2)->each(function ($user) {
            $user->profile()->create(
                Profile::factory()->make()->toArray()
            );
        });

         $this->call([
            CategoryAndProductSeeder::class,
             OrderSeeder::class,
         ]);
    }
}
