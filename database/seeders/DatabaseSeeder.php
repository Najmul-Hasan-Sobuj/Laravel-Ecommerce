<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\Brand::factory(50)->create();
        \App\Models\Category::factory(50)->create();
        // \App\Models\ChildCategory::factory(50)->create();
        // \App\Models\Page::factory(50)->create();
        // \App\Models\Product::factory(50)->create();
        // \App\Models\Seo::factory(50)->create();
        // \App\Models\Smtp::factory(50)->create();
        // \App\Models\SubCategory::factory(50)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
