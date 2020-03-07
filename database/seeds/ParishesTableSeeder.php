<?php

use Illuminate\Database\Seeder;

class ParishesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Parish::class, 2)->create()->each(function($parish) {
            $parish->zones()->save(factory(App\Zone::class,3)->make()->each(function($zone) {
                $zone->communities()->save(factory(App\Community::class,3)->make());
            }));
        });
    }
}
