<?php

use App\Section;
use App\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Faker $faker
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 15; $i++) {
            $currentSection = Section::create([
                'name' => $faker->name,
                'description' => $faker->sentence,
                'logo' => $i.'.jpg',
            ])->id;

            $numbers = range(1, 15);
            shuffle($numbers);
            $users = array_slice($numbers, 0, rand(0, 4));

            $section = Section::find($currentSection);
            $section->users()->attach($users);
        }
    }
}
