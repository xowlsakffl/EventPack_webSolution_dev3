<?php

use App\LayoutEtc;
use Illuminate\Database\Seeder;

class LayoutEtcSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(LayoutEtc::class, 1)->create(); 
    }
}
