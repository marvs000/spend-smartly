<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\IncomeCutOff;

class IncomeCutOffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $type = IncomeCutOff::insert([
            [ "day" => 10, "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s') ],
            [ "day" => 15, "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s') ],
            [ "day" => 24, "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s') ],
            [ "day" => 30, "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s') ],
            [ "day" => 31, "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s') ]
        ]);
    }
}
