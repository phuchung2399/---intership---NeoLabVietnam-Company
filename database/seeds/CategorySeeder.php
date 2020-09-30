<?php

use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();

        Category::create(
            ['category_name' => 'Android'],
        );
        Category::create(
            ['category_name' => 'iOS'],
        );
        Category::create(
            ['category_name' => 'Laptop'],
        );
        Category::create(
            ['category_name' => 'PC'],
        );
    }
}
