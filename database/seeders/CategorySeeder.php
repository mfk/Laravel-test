<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::updateOrCreate(
            [
                'id' => 1,
                'title' => 'Sport',
            ]
        );

        Category::updateOrCreate(
            [
                'id' => 2,
                'title' => 'Airsoft',
            ]
        );

        Category::updateOrCreate(
            [
                'id' => 3,
                'title' => 'Cars',
            ]
        );

        Category::updateOrCreate(
            [
                'id' => 4,
                'title' => 'Food',
            ]
        );

        Category::updateOrCreate(
            [
                'id' => 5,
                'title' => 'Others',
            ]
        );
    }
}
