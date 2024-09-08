<?php

namespace Database\Seeders;

use App\Models\Apps\Visitor;
use App\Models\Apps\VisitorReceipt;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DataClearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Visitor::truncate();
        VisitorReceipt::truncate();
        Schema::enableForeignKeyConstraints();
    }
}
