<?php

use Illuminate\Database\Seeder;

class Forilegium extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Forilegium::class, 20)->create();
    }
}
