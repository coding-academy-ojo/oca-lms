<?php

use Illuminate\Database\Seeder;
use App\TechnologyCategory;

class TechnologyCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TechnologyCategory::create(['Categories_name' => 'Frontend']);
        TechnologyCategory::create(['Categories_name' => 'Backend']);
        TechnologyCategory::create(['Categories_name' => 'Database']);
    }
}
