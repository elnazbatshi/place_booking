<?php

namespace Database\Seeders;

use App\Http\Controllers\TypeCategoryController;
use App\Models\TypeCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $TypeCategory = [
            [
                'id'   => 1,
                'name' => 'slider',
            ],
            [
                'id'   => 2,
                'name' => 'madule',
            ],
            [
                'id'   => 3,
                'name' => 'post',
            ],

        ];
        TypeCategory::truncate();
        TypeCategory::insert($TypeCategory);
    }
}
