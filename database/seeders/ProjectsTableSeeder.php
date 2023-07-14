<?php

namespace Database\Seeders;

use App\Models\Type;
use App\Models\Project;
use App\Models\Technology;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $types = Type::all();
        $technologies = Technology::all()->pluck('id');

        for($i = 0; $i < 50; $i++) {
            $name = $faker->words(rand(2, 10), true);
            $slug = Project::slugger($name);

            $project = Project::create([
            'type_id'               => $faker->randomElement($types)->id,
            'name'                  => $name,
            'slug'                  => $slug,
            'client_name'           => $faker->name(),
            'date'                  => $faker->date(),
            'cover_image'           => 'https://picsum.photos/id/' . rand(1, 270) . '/500/400',
            'summary'               => $faker->paragraphs(rand(2, 20), true),
            ]);

            $project->technologies()->sync($faker->randomElements($technologies, null));
        }
    }
}
