<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Reply;
use App\Models\Topic;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Topic::withoutEvents(function () {

            $this->call([
                UserSeeder::class,
                TopicSeeder::class,
                ReplySeeder::class,
            ]);

        });
//        $this->call([
//           UserSeeder::class,
//            TopicSeeder::class,
//            ReplySeeder::class,
//        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
