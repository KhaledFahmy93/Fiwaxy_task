<?php

use Illuminate\Database\Seeder;
use App\Models\Service;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            HourratesTableSeeder::class,
            OrdersTableSeeder::class,
            OrderdetailsTableSeeder::class,
        ]);
    }
}
