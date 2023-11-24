<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Pensil',
                'category' => 'ATK',
                'price' => 15000
            ],
            [
                'name' => 'Sapu',
                'category' => 'RT',
                'price' => 40000
            ],
            [
                'name' => 'Payung',
                'category' => 'RT',
                'price' => 70000
            ]
        ];

        Item::insert($data);
    }
}
