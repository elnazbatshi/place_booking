<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\TypeCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();
        $categories = [
            "مقاله اول", "مقاله دوم", "مقاله سوم"
        ];
        $typeCategories = TypeCategory::all()->pluck('id');
        foreach ($categories as $cat) {
            foreach ($typeCategories as $type) {
                Category::create([
                    'title'   => $cat,
                    'type_id' => $type
                ]);
            }
        }
    }
}
