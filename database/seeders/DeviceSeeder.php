<?php

namespace Database\Seeders;

use App\Models\Device;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            'area_id' => 1,'code' => 'caja-verde-001' , 'name' => 'Caja nro 1' , 'description' => 'Blablablablblabla','regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50
        ];
        Device::insert($data);
    }
}
