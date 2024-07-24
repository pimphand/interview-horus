<?php

namespace Database\Seeders;

use App\Models\Voucher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i < 8; $i++) {
            Voucher::create([
                'category_id' => $i % 2 === 0 ? 1 : 2,
                'name' => 'Voucher ' . $i,
                'photo' => "voucher.png",
                'status' => $i % 2 === 0,
                'amount' => $i * 1000
            ]);
        }
    }
}
