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
        factory(App\Models\Hourrate::class, 5)->create()->each(function ($hourrate) {
            factory(App\Models\Service::class)->create(['id' => $hourrate->service_id]);
            factory(App\Models\Area::class)->create(['id' => $hourrate->area_id]);
        });
    }
}
