<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\IncomeCategory;

class IncomeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $category = IncomeCategory::insert([
        //     [ "category" => "MARVIN SALARY", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s') ],
        //     [ "category" => "MARVIN ALLOWANCE", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s') ],
        //     [ "category" => "MARVIN PERKS", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s') ],
        //     [ "category" => "MARVIN CIP", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s') ],
        //     [ "category" => "MARVIN BONUS", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s') ],
        //     [ "category" => "MARVIN SIDELINE", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s') ],
        //     [ "category" => "CRISTEL SALARY", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s') ],
        //     [ "category" => "CRISTEL BONUS", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s') ],
        // ]);

        $category = IncomeCategory::insert([
            [ "title" => "Marvin", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s') ],
            [ "title" => "Cristel", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s') ]
        ]);
    }
}
