<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\IncomeType;

class IncomeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $type = IncomeType::insert([
            [ "title" => "Salary", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s') ],
            [ "title" => "Allowance", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s') ],
            [ "title" => "Perks", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s') ],
            [ "title" => "Bonus", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s') ],
            [ "title" => "13th/14th Month", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s') ],
            [ "title" => "CIP", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s') ],
            [ "title" => "Sideline", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s') ]
        ]);
    }
}
