<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data=[
            ['code' => 'jardin-norte' , 'name' => 'Zona Norte' , 'description' => 'Jardin ubicado en la zona norte del mall' , 'regular_flow' => 1000 , 'peak_flow' => 2000 , 'minimum_flow' => 500]
        ];
        Area::insert($data);
    }
}
