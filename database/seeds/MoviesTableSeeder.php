<?php

use Illuminate\Database\Seeder;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Movie::class, 50)->create()->each(function($movie){
            $movie->user()->save(factory(App\User::class)->make());
        });
    }
}
