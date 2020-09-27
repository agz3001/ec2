<?php

use Illuminate\Database\Seeder;
use App\Shop;
use App\Cart;
class ShopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Shop::class, 20)->create();
    }
}
