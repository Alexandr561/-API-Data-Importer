<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ClearData extends Command
{
    protected $signature = 'clear:data';

    public function handle()
    {
        if ($this->confirm('Очистить все таблицы?', true)) {
            DB::table('sales')->truncate();
            DB::table('orders')->truncate();
            DB::table('stocks')->truncate();
            DB::table('incomes')->truncate();

            $this->info('✅ Все таблицы очищены!');
        }
    }
}
