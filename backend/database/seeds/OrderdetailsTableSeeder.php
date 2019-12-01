<?php

use Illuminate\Database\Seeder;

class OrderdetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Orderdetail::class, 5)->create();
    }
}
