<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Type::create(['name' => 'Horror', 'description' => 'Horror játékok']);
        Type::create(['name' => 'RPG', 'description' => 'RPG játékok']);
        Type::create(['name' => 'Verseny', 'description' => 'Verseny játékok']);
    }
}
