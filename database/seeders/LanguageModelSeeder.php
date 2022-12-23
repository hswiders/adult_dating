<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LanguageModel;
class LanguageModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['English' , 'Hindi' , 'Russia' , 'French' , 'Tamil'];
        foreach ($data as $key => $value) {
            $insert['title'] = $value;
            LanguageModel::insert($insert);
        }
        
        
    }
}
