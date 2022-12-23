<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\nationalityModel;

class NationalityModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['Indian' , 'Afghan' , 'Albanian' , 'Algerian' , 'American' , 'Canadian'];
        foreach ($data as $key => $value) {
            $insert['title'] = $value;
            nationalityModel::insert($insert);
        }
    }
}
