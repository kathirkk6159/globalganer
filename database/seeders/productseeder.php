<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class productseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('product_table_custom')->insert([
            [
                'name' => 'Lg mobile',
                "price" => "200",
                "description" => "A smart  phone with  4gb ram and much more features",
                "image" => "https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.lg.com%2Fin%2Fmobile-phones&psig=AOvVaw382nPdWBQqlvxWakOhoGXs&ust=1635067801135000&source=images&cd=vfe&ved=0CAsQjRxqFwoTCPjYreec4PMCFQAAAAAdAAAAABAD"
            ]
            ]);
    }
}
