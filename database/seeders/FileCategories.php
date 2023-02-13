<?php

namespace Database\Seeders;

use App\Models\FileCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FileCategories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {
        $categories = [
            ['id' => 1, 'name' => 'board reports'],
            ['id' => 2, 'name' => 'intern reports'],
            ['id' => 3, 'name' => 'design proposals'],

        ];

        foreach ($categories as $category) {
            FileCategory::updateOrCreate(['id' => $category['id']], $category);
        }
    }
}
