<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $statuses = [
            ['id' => 1, 'name' => 'pending'],
            ['id' => 2, 'name' => 'approved'],
            ['id' => 3, 'name' => 'rejected'],

        ];

        foreach ($statuses  as $status) {
            Status::updateOrCreate(['id' => $status['id']], $status);
        }
    }
}
