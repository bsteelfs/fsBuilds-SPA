<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'username' => 'Fast Spring',
        //     'name' => 'Fast',
        //     'surname' => 'Spring',
        //     'email' => 'test@fastspring.com',
        //     'password' => bcrypt('FastSpring1234'),
        //     'fs_account_id' => 'Po4-MoBxTCCr9iGvp7bG8w'
        // ]);
        // \App\Models\User::factory()->create([
        //     'username' => 'nugo skhir',
        //     'name' => 'nugo',
        //     'surname' => 'skhir',
        //     'email' => 'nskhi@gmail.com',
        //     'password' => bcrypt('nugo1234'),
        //     'fs_account_id' => 'zosgPO3mTpGNYjDCQnER1g'
        // ]);
        \App\Models\User::factory()->create([
            'username' => 'FastSpring',
            'name' => 'Braden',
            'surname' => 'Steel',
            'email' => 'fstest4@bradensteel.com',
            'password' => bcrypt('FastSpring1234'),
        ]);
    }
}
