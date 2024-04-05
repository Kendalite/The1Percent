<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'id' => 0,
            'name' => 'The Computer',
            'email' => 'thecomputer@the1percent.com',
            'username' => 'theComputer',
            'password' => bcrypt('thecomputer@the1percent.com'),
            'role' => 'admin',
        ]);
        $this->call([
            JukeboxSeederThe1Percent::class,
        ]);
    }
}
