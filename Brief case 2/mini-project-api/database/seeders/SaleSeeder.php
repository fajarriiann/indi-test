<?php

namespace Database\Seeders;

use App\Models\Sale;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'tgl' => date('d-m-y'),
                'customer_id' => 1,
                'total' => 15000
            ],
            [
                'tgl' => date('d-m-y'),
                'customer_id' => 2,
                'total' => 110000
            ]
        ];

        Sale::insert($data);
    }
}
