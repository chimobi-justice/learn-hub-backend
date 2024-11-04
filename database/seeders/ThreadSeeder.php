<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Thread;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ThreadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            Thread::factory(50)->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
