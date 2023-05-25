<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('authors')->insert([
            'name' => 'Chinua Achebe',
        ]);
        DB::table('authors')->insert([
            'name' => 'Cyprian Ekwensi',
        ]);
        DB::table('authors')->insert([
            'name' => 'William Shakespeare',
        ]);
    
    }
}
