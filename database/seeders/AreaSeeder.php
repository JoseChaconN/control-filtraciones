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
            ['code' => 'zona-rs' , 'name' => 'Zonas riego solar' , 'regular_flow' => 1000 , 'peak_flow' => 2000 , 'minimum_flow' => 500],
            ['code' => 'zona-pa' , 'name' => 'Zonas Programadores Autonomos' , 'regular_flow' => 1000 , 'peak_flow' => 2000 , 'minimum_flow' => 500],
        ];
        Area::insert($data);
    }
}
