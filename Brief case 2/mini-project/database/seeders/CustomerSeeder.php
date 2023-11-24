<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name'  => 'Andi',
                'domisili' => 'Jakarta Utara',
                'gender' => 'PRIA'
            ],
            [
                'name'  => 'Budi',
                'domisili' => 'Jakarta Barat',
                'gender' => 'PRIA'
            ],
            [
                'name'  => 'Shinta',
                'domisili' => 'Jakarta Timur',
                'gender' => 'WANITA'
            ],
        ];

        Customer::insert($data);
    }
}
