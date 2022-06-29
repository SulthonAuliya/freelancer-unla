<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(3)->create();

        Category::create([
            'nama_category'     => 'Programming',
            'slug'              => 'programming'
        ]);
        Category::create([
            'nama_category'     => 'Economy',
            'slug'              => 'economy'
        ]);
        Category::create([
            'nama_category'     => 'Design',
            'slug'              => 'design'
        ]);

        Job::factory(15)->create();
    }
}
