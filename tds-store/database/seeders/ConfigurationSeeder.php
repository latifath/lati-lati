<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('configurations')->insert([
        "tva"=> 1,
        "created_at"=> "NULL",
        "updated_at"=> "NULL"
       ]);
    }
}
