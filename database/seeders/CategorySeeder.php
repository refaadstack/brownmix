<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
          'name' => ('Fromage Cheesecake'),  
        ]);

        DB::table('categories')->insert([
            'name' => ('Menu Box'),  
          ]);
        DB::table('categories')->insert([
            'name' => ('Desert Bowl'),  
          ]);
    }
}
