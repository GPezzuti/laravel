<?php

namespace Database\Seeders;

use App\Models\Photo;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->has(
            Photo::factory()
                ->count(3)
                ->state(function (array $attributes, User $user) {
                    return ['user_id' => $user->id];
                })
        )->create();

        /*  User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
         ]); */

        /* $user = User::factory()->unverified()->create(); */
    }
}
