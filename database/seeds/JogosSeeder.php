<?php

use Illuminate\Database\Seeder;

use App\Jogos;

class JogosSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Jogos::class, 30)->create();
    }
}
