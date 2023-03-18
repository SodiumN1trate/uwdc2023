<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Zone;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Zone::create([
            'name' => 'The Office',
            'color' => 'rgb(255, 0, 0, 0.3)',
            'x' => 93,
            'y' => 20,
            'width' => 145,
            'height' => 150,
            'users_count' => 4
        ]);

        Zone::create([
            'name' => 'Meeting room',
            'color' => 'rgba(255, 77, 0, 0.3)',
            'x' => 243,
            'y' => 20,
            'width' => 232,
            'height' => 150,
            'users_count' => 15
        ]);

        Zone::create([
            'name' => 'Breakroom',
            'color' => 'rgba(255, 77, 0, 0.3)',
            'x' => 843,
            'y' => 20,
            'width' => 150,
            'height' => 170,
            'users_count' => 5
        ]);

        Zone::create([
            'name' => 'Desk',
            'color' => 'rgba(255, 77, 0, 0.3)',
            'x' => 12,
            'y' => 218,
            'width' => 110,
            'height' => 100,
            'users_count' => 3
        ]);

        Zone::create([
            'name' => 'Open Office 1',
            'color' => 'rgba(140, 255, 0, 0.32)',
            'x' => 125,
            'y' => 218,
            'width' => 350,
            'height' => 168,
            'users_count' => 9
        ]);

        Zone::create([
            'name' => 'Kitchen',
            'color' => 'rgba(255, 77, 0, 0.3)',
            'x' => 480,
            'y' => 235,
            'width' => 280,
            'height' => 100,
            'users_count' => 5
        ]);

        Zone::create([
            'name' => 'Open office 2',
            'color' => 'rgba(140, 255, 0, 0.32)',
            'x' => 760,
            'y' => 190,
            'width' => 230,
            'height' => 205,
            'users_count' => 4
        ]);

        Zone::create([
            'name' => 'Silent room 1',
            'color' => 'rgba(0, 166, 255, 0.32)',
            'x' => 345,
            'y' => 384,
            'width' => 134,
            'height' => 117,
            'users_count' => 1
        ]);

        Zone::create([
            'name' => 'Silent room 2',
            'color' => 'rgba(0, 166, 255, 0.32)',
            'x' => 546,
            'y' => 337,
            'width' => 77,
            'height' => 56,
            'users_count' => 1
        ]);

        Zone::create([
            'name' => 'Silent room 3',
            'color' => 'rgba(0, 166, 255, 0.32)',
            'x' => 824,
            'y' => 397,
            'width' => 172,
            'height' => 102,
            'users_count' => 2
        ]);
    }

}
