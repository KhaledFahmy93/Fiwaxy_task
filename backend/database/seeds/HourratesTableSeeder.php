<?php

use Illuminate\Database\Seeder;

class HourratesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Hourrate::class, 5)->create();
    }
}
