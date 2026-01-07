<?php

namespace Database\Seeders;

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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
        ]);

        // $user = [
        //     [
		// 		'id' => 1,
		// 		'name' => 'Admin',
		// 		'email' => 'admin@admin.com',
		// 		'email_verified_at' => now(),
		// 		'password' => Hash::make('123456'),
		// 		'created_at' => now(),
		// 		'updated_at' => now(),
        //     ]
        // ];

        // DB::table('users')->insert($user);
    }
}
