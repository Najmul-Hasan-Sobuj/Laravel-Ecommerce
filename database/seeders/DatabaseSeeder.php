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
        \App\Models\Category::factory(50)->create();
        \App\Models\Warehouse::factory(50)->create();
        \App\Models\Coupon::factory(50)->create();
        \App\Models\PickUpPoint::factory(50)->create();
        \App\Models\Category::factory(50)->create();
        // \App\Models\SubCategory::factory(50)->create();
        // \App\Models\ChildCategory::factory(50)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
