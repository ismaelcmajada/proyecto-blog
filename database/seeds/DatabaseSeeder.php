<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Category;
use App\Author;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables([
            'users',
            'categories',
            'authors',
            'posts'
        ]);
        $this->call(CategoriesTableSeeder::class);
        $this->call(AuthorsTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        // $this->call(UsersTableSeeder::class);
    }

    public function truncateTables(array $tables) {
        foreach($tables as $table) {
            DB::statement("TRUNCATE TABLE {$table} RESTART IDENTITY CASCADE");
        }
    }
}
