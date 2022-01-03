<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('expenses')->insert([
            'date' => '20220101',
            'payment' => '電子マネー',
            'category' => '食費',
            'amount' => 1000,
        ]);

        DB::table('expenses')->insert([
            'date' => '20220102',
            'payment' => 'クレジットカード',
            'category' => 'ファッション',
            'amount' => 15000,
        ]);

        DB::table('expenses')->insert([
            'date' => '20220103',
            'payment' => '現金',
            'category' => '交通費',
            'amount' => 800,
        ]);
    }
}