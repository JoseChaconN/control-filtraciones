<?php

namespace Database\Seeders;

use App\Models\Device;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            ['area_id' => 1, 'code' => 'device-a1', 'name' => 'A1', 'longitude' => -70.60925734583924 , 'latitude' => -33.50908621714348 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 1, 'code' => 'device-a2', 'name' => 'A2', 'longitude' => -70.60838026212109 , 'latitude' => -33.50877818967467 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 1, 'code' => 'device-a3', 'name' => 'A3', 'longitude' => -70.60815084552779 , 'latitude' => -33.50886977697045 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 1, 'code' => 'device-a4', 'name' => 'A4', 'longitude' => -70.60635411187029 , 'latitude' => -33.50921159385197 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 1, 'code' => 'device-a6', 'name' => 'A6', 'longitude' => -70.6060927952425 , 'latitude' => -33.50933581112022 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 1, 'code' => 'device-a5', 'name' => 'A5', 'longitude' => -70.60586638938226 , 'latitude' => -33.50900544230799 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 1, 'code' => 'device-a7', 'name' => 'A7', 'longitude' => -70.60522525441328 , 'latitude' => -33.50917517065911 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 1, 'code' => 'device-a8', 'name' => 'A8', 'longitude' => -70.60474298412662 , 'latitude' => -33.5093913311994 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 1, 'code' => 'device-a9', 'name' => 'A9', 'longitude' => -70.60462999940526 , 'latitude' => -33.50974876663769 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 1, 'code' => 'device-a10', 'name' => 'A10', 'longitude' => -70.60442762907502 , 'latitude' => -33.51093847722709 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 1, 'code' => 'device-a11', 'name' => 'A11', 'longitude' => -70.60402491915201 , 'latitude' => -33.51097025439446 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 1, 'code' => 'device-a12', 'name' => 'A12', 'longitude' => -70.60325818904076 , 'latitude' => -33.51112794656544 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 1, 'code' => 'device-a16', 'name' => 'A16', 'longitude' => -70.6033994639034 , 'latitude' => -33.51207162783947 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 1, 'code' => 'device-a15', 'name' => 'A15', 'longitude' => -70.60334311479365 , 'latitude' => -33.51201004964158 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 1, 'code' => 'device-a13', 'name' => 'A13', 'longitude' => -70.60342397273187 , 'latitude' => -33.51171698452476 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 1, 'code' => 'device-a14', 'name' => 'A14', 'longitude' => -70.60363408114094 , 'latitude' => -33.51173086520554 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 1, 'code' => 'device-a17', 'name' => 'A17', 'longitude' => -70.603785070922 , 'latitude' => -33.51200160273087 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 1, 'code' => 'device-a18', 'name' => 'A18', 'longitude' => -70.60574324199314 , 'latitude' => -33.51234471927238 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e1', 'name' => 'E1', 'longitude' => -70.60658795571203 , 'latitude' => -33.50903013528727 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e2', 'name' => 'E2', 'longitude' => -70.60700100436912 , 'latitude' => -33.50967196661277 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e3', 'name' => 'E3', 'longitude' => -70.60675804899201 , 'latitude' => -33.50974865372964 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e4', 'name' => 'E4', 'longitude' => -70.60651216347463 , 'latitude' => -33.50973818207759 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e5', 'name' => 'E5', 'longitude' => -70.60569434539593 , 'latitude' => -33.50976570109965 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e6', 'name' => 'E6', 'longitude' => -70.6052610685842 , 'latitude' => -33.51010401986993 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e7', 'name' => 'E7', 'longitude' => -70.60501829395911 , 'latitude' => -33.51024602241097 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e8', 'name' => 'E8', 'longitude' => -70.60480593078132 , 'latitude' => -33.51042157564643 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e9', 'name' => 'E9', 'longitude' => -70.60459826757136 , 'latitude' => -33.51068288066005 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e10', 'name' => 'E10', 'longitude' => -70.60366752647748 , 'latitude' => -33.51053574587832 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e11', 'name' => 'E11', 'longitude' => -70.60309057612008 , 'latitude' => -33.51153665556393 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e12', 'name' => 'E12', 'longitude' => -70.60411690955623 , 'latitude' => -33.51136270993526 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e13', 'name' => 'E13', 'longitude' => -70.60477001628691 , 'latitude' => -33.51150873333334 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e14', 'name' => 'E14', 'longitude' => -70.60467318332938 , 'latitude' => -33.51157876203954 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e15', 'name' => 'E15', 'longitude' => -70.60414939816597 , 'latitude' => -33.51133274006602 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e16', 'name' => 'E16', 'longitude' => -70.60505901619827 , 'latitude' => -33.51150123965402 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e17', 'name' => 'E17', 'longitude' => -70.60414939816597 , 'latitude' => -33.51133274006602 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e18', 'name' => 'E18', 'longitude' => -70.60414939816597 , 'latitude' => -33.51133274006602 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e19', 'name' => 'E19', 'longitude' => -70.60354608941164 , 'latitude' => -33.51183184943638 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e20', 'name' => 'E20', 'longitude' => -70.60354608941164 , 'latitude' => -33.51183184943638 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e21', 'name' => 'E21', 'longitude' => -70.60527039846178 , 'latitude' => -33.51207905437128 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e22', 'name' => 'E22', 'longitude' => -70.60524404096819 , 'latitude' => -33.51231328255427 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e23', 'name' => 'E23', 'longitude' => -70.60354608941164 , 'latitude' => -33.51183184943638 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e24', 'name' => 'E24', 'longitude' => -70.60589735408016 , 'latitude' => -33.51233668237548 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e25', 'name' => 'E25', 'longitude' => -70.60559993955523 , 'latitude' => -33.51200454301371 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e26', 'name' => 'E26', 'longitude' => -70.60354608941164 , 'latitude' => -33.51183184943638 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e27', 'name' => 'E27', 'longitude' => -70.60631360754208 , 'latitude' => -33.51160814119174 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e28', 'name' => 'E28', 'longitude' => -70.6061018495553 , 'latitude' => -33.51186555155904 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e29', 'name' => 'E29', 'longitude' => -70.606062314694 , 'latitude' => -33.51219426677186 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e30', 'name' => 'E30', 'longitude' => -70.60565822318333 , 'latitude' => -33.51145461802653 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e31', 'name' => 'E31', 'longitude' => -70.60565822318333 , 'latitude' => -33.51145461802653 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e32', 'name' => 'E32', 'longitude' => -70.60601330806472 , 'latitude' => -33.51156268118451 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e33', 'name' => 'E33', 'longitude' => -70.60601330806472 , 'latitude' => -33.51156268118451 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e34', 'name' => 'E34', 'longitude' => -70.60664384745542 , 'latitude' => -33.51228606608392 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e35', 'name' => 'E35', 'longitude' => -70.60629456408633 , 'latitude' => -33.51138655651014 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e36', 'name' => 'E36', 'longitude' => -70.60708593176898 , 'latitude' => -33.51193150434349 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e37', 'name' => 'E37', 'longitude' => -70.60702691575482 , 'latitude' => -33.51147415786872 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e38', 'name' => 'E38', 'longitude' => -70.60702691575482 , 'latitude' => -33.51147415786872 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e39', 'name' => 'E39', 'longitude' => -70.60694867955712 , 'latitude' => -33.51092843063739 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e40', 'name' => 'E40', 'longitude' => -70.60694867955712 , 'latitude' => -33.51092843063739 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e41', 'name' => 'E41', 'longitude' => -70.60694867955712 , 'latitude' => -33.51092843063739 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e42', 'name' => 'E42', 'longitude' => -70.60694867955712 , 'latitude' => -33.51092843063739 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e43', 'name' => 'E43', 'longitude' => -70.60777239894388 , 'latitude' => -33.51041241515083 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e44', 'name' => 'E44', 'longitude' => -70.60799840873067 , 'latitude' => -33.51080871571835 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e45', 'name' => 'E45', 'longitude' => -70.60805330991575 , 'latitude' => -33.51031692225093 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e46', 'name' => 'E46', 'longitude' => -70.60805330991575 , 'latitude' => -33.51031692225093 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e47', 'name' => 'E47', 'longitude' => -70.60887932421545 , 'latitude' => -33.51024411741157 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e48', 'name' => 'E48', 'longitude' => -70.60948480742891 , 'latitude' => -33.50985601095984 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e49', 'name' => 'E49', 'longitude' => -70.6087592955998 , 'latitude' => -33.50949793573509 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e50', 'name' => 'E50', 'longitude' => -70.6087592955998 , 'latitude' => -33.50949793573509 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e51', 'name' => 'E51', 'longitude' => -70.6087592955998 , 'latitude' => -33.50949793573509 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e52', 'name' => 'E52', 'longitude' => -70.60849113818969 , 'latitude' => -33.50892011603387 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
            ['area_id' => 2 , 'code' => 'device-e53', 'name' => 'E53', 'longitude' => -70.60900950753606 , 'latitude' => -33.50888252571645 , 'regular_flow' => 100 , 'peak_flow' => 200 , 'minimum_flow' => 50 , 'token' => Str::random(60)],
        ];
        Device::insert($data);
    }
}
