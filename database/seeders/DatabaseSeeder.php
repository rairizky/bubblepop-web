<?php

namespace Database\Seeders;

use App\Models\User;
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
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'superadmin',
            'email' => 'superadmin@bubblepop.my.id',
            'password' => bcrypt('superadmin123'),
            'role' => 'superadmin'
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@bubblepop.my.id',
            'password' => bcrypt('admin123'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'cashier',
            'email' => 'cashier@bubblepop.my.id',
            'password' => bcrypt('cashier123'),
            'role' => 'cashier'
        ]);
    }
}
