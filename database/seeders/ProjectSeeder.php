<?php

namespace Database\Seeders;

use App\Models\Type;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $typeIds = Type::all()->pluck('id');
        
        for ($i = 0; $i < 20; $i++) {
            $newProject = new Project();
            $newProject->type_id = $faker->randomElement($typeIds);
            $newProject->title = $faker->unique()->slug(3);
            $newProject->description = $faker->paragraph();
            $newProject->link = $faker->url();
            $newProject->creation_date = $faker->date();
            $newProject->image = $faker->imageUrl(640, 480, 'sites', true);
            $newProject->slug = $newProject->title;
            $newProject->save();
            $newProject->slug = $newProject->id . "-" . $newProject->title;
            $newProject->save();
        }
    }
}
