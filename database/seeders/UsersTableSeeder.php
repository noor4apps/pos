<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name' => 'super',
            'last_name' => 'ad',
            'email' => 'super_admin@app.com',
            'password' => bcrypt('12345678'),
        ]);
        $user->attachRole('super_admin');

    }// end of run

}// end of seeder
