<?php

use App\Models\Province;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonProvinces = \Illuminate\Support\Facades\File::get(database_path('json/provinces.json'));
        $dataProvinces = json_decode($jsonProvinces);
        $dataProvinces = collect($dataProvinces);

        foreach ($dataProvinces as $d) {
            Province::create([
                'code' => $d->province_code,
                'name' => ucwords(strtolower($d->province_name)),
                'name_en' => ucwords(strtolower($d->province_name_en)),
            ]);
        }
    }
}
