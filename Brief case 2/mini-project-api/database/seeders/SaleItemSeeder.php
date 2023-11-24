<?php

namespace Database\Seeders;

use App\Models\SaleItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaleItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'sale_id' => 1,
                'item_id' => 1,
                'qty' => 1
            ],
            [
                'sale_id' => 2,
                'item_id' => 2,
                'qty' => 1
            ],
            [
                'sale_id' => 2,
                'item_id' => 3,
                'qty' => 1
            ]
        ];

        SaleItem::insert($data);
    }
}
