<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class NewsCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [];

        $cName = 'Main category';

        $categories[] = [
            'title' => $cName,
            'slug' => Str::slug($cName),
            'parent_id' => 0
        ];

        for ($i = 1; $i <= 15; $i++) {
            $cName = 'Category № ' . $i;
            try {
                $parentId = $i > 4 ? random_int(1, 4) : 1;
            } catch (\Exception $e) {
                $parentId = 1;
            }

            $categories[] = [
                'title' => $cName,
                'slug' => Str::slug($cName),
                'parent_id' => $parentId
            ];
        }

        \DB::table('news_categories')->insert($categories);
    }
}