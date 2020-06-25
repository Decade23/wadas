<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class SubdistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function run()
    {
        $jsonSubistricts = File::get(database_path('json/subdistricts.json'));
        $dataSubdistricts = json_decode($jsonSubistricts);
        $dataSubdistricts = collect($dataSubdistricts);

        foreach ($dataSubdistricts as $d) {

            \App\Models\Subdistricts::create([
                'urban'         => ucwords(strtolower($d->urban)),
                'sub_district'  => ucwords(strtolower($d->sub_district)),
                'city'          => ucwords(strtolower($d->city)),
                'province_code' => $d->province_code,
                'postal_code'   => $d->postal_code,
            ]);

            if(env('APP_ENV') == 'local'){
                break;
            }
        }
    }
}
