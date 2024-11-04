<?php

namespace Database\Seeders;

use App\Models\Thread;
use App\Models\ThreadComment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ThreadCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $threads = Thread::all();

        foreach ($threads as $thread) {
            foreach ($users->random(15) as $user) {
                ThreadComment::factory()->create([
                    'thread_id' => $thread->id,
                    'user_id' => $user->id,
                ]);
            }
        }
        
    }
}
