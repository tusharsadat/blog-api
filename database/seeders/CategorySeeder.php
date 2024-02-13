<?php

namespace Database\Seeders;

use App\Models\Category;
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
        Category::create([
            'category_name' => 'HTML',
            'slug' => 'html1'
        ]);
        Category::create([
            'category_name' => 'PHP',
            'slug' => 'php1'
        ]);
        Category::create([
            'category_name' => 'JAVA',
            'slug' => 'java1'
        ]);
    }
}
