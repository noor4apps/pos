<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client1['name'] = 'client 1';
        $client1['phone'] = [
            'phone.1' => '0999887744',
            'phone.2' => '0332255118'
        ];
        $client1['address'] = 'line address street';

        Client::create($client1);
    }
}
