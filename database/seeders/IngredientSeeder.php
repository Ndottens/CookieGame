<?php

namespace Database\Seeders;

use App\Enums\IngredientName;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $this->ingredientSeeder();
    }

    public function ingredientSeeder()
    {
        DB::table('ingredients')->insert([
            'name' => IngredientName::BUTTERSCOTCH,
            'capacity' => '-1',
            'durability' => '-2',
            'taste' => '6',
            'texture' => '3',
            'calories' => '8',
        ]);

        DB::table('ingredients')->insert([
            'name' => IngredientName::CINNAMON,
            'capacity' => '2',
            'durability' => '3',
            'taste' => '-2',
            'texture' => '-1',
            'calories' => '3',
        ]);
    }
}
