<?php

namespace Database\Seeders;

use App\Models\Coupon;
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
        $this->call([RoleSeeder::class, PermissionSeeder::class]);

        \App\Models\User::factory(15)->create();
        \App\Models\Category::factory(15)->create();
        \App\Models\Product::factory(50)->create();
        \App\Models\Order::factory(100)->create();
        \App\Models\Review::factory(500)->create();

        \App\Models\User::factory([
            'email' => 'admin@admin.com',
            'role_id' => 1
        ])->create();

        Coupon::create([
            'code' => 'ABC123',
            'type' => 'percent',
            'amount' => 30,
            'expiry_date' => now()->subMonth()
        ]);
    }
}
