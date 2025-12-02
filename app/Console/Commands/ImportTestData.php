<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class ImportTestData extends Command
{
    protected $signature = 'import:test';

    public function handle()
    {
        $today = date('Y-m-d');

        echo "🧪 Тестовый импорт (по 5 страниц)...\n\n";

        echo " Продажи (sales):\n";
        $this->importWithLimit('sales', '2025-01-01', $today, 5);

        // Orders - 5 страниц
        echo " Заказы (orders):\n";
        $this->importWithLimit('orders', '2025-01-01', $today, 5);

        // Stocks - 3 страницы (только сегодня)
        echo " Остатки (stocks):\n";
        $this->importWithLimit('stocks', $today, null, 3);

        // Incomes - 5 страниц
        echo " Поступления (incomes):\n";
        $this->importWithLimit('incomes', '2025-01-01', $today, 5);

        echo "\n✅ Тестовый импорт завершён!\n";

        // Покажем статистику
        $this->showStats();
    }

    private function importWithLimit($table, $dateFrom, $dateTo, $maxPages)
    {
        $page = 1;
        $totalRecords = 0;

        while ($page <= $maxPages) {
            // Параметры запроса
            $params = [
                'dateFrom' => $dateFrom,
                'page' => $page,
                'limit' => 500,
                'key' => 'E6kUTYrYwZq2tN4QEtyzsbEBk3ie'
            ];

            if ($dateTo) {
                $params['dateTo'] = $dateTo;
            }

            // Запрос к API
            $response = Http::get("http://109.73.206.144:6969/api/{$table}", $params);

            if (!$response->successful()) {
                echo "  ❌ Ошибка: HTTP {$response->status()}\n";
                break;
            }

            $data = $response->json();

            if (empty($data['data'])) {
                echo "  ℹ️ Нет данных\n";
                break;
            }

            // Сохраняем в БД (игнорируем дубликаты)
            try {
                DB::table($table)->insert($data['data']);
                $count = count($data['data']);
                $totalRecords += $count;
                echo "  Страница {$page}: {$count} записей\n";
            } catch (\Exception $e) {
                echo "  Страница {$page}: пропущены дубликаты\n";
            }

            $page++;
            sleep(0.5); // Полсекунды паузы
        }

        echo "  Всего: {$totalRecords} записей\n";
    }

    private function showStats()
    {
        echo "\n Статистика: \n";
        echo "=============\n";

        $tables = ['sales', 'orders', 'stocks', 'incomes'];

        foreach ($tables as $table) {
            $count = DB::table($table)->count();
            echo "{$table}: {$count} записей\n";
        }
    }
}
