<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $salaries = [
            [
                'value' => 10000,
       ],
       [
        'value' => 20000,
       ],
       [
        'value' => 30000,
       ],
       [
           'value' => 40000,
       ],
       [
        'value' => 50000,
       ],
   
       ];

       foreach ($salaries as $category) {
           \App\Models\Salary::create($category);
       }
    }
}
