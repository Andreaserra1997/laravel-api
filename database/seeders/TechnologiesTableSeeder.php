<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technologies = [
            [
                'name'  => 'html'
            ],
            [
                'name'  => 'css'
            ],
            [
                'name'  => 'js'
            ],
            [
                'name'  => 'bootstrap'
            ],
            [
                'name'  => 'vue.js'
            ],
            [
                'name'  => 'react'
            ],
            [
                'name'  => 'laravel'
            ],
            [
                'name'  => 'angular'
            ],
        ];

        foreach ($technologies as $technology) {
            Technology::create($technology);
        }
    }
}
