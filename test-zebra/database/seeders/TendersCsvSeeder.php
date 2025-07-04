<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Exception;
use League\Csv\Reader;
use Carbon\Carbon;

class TendersCsvSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws Exception
     */
    public function run(): void
    {
        $csv = Reader::createFromPath(storage_path('../test_task_data.csv'), 'r');
        $csv->setHeaderOffset(0);

        foreach ($csv as $record) {
            DB::table('tenders')->insert([
                'external_code' => (int)$record['Внешний код'],
                'number' => $record['Номер'],
                'status' => $record['Статус'],
                'name' => $record['Название'],
                'updated_at' => Carbon::createFromFormat('d.m.Y H:i:s', $record['Дата изм.']),
            ]);
        }
    }
}
