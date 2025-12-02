<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('income_id');
            $table->string('number', 50)->nullable();
            $table->date('date');
            $table->date('last_change_date');
            $table->string('supplier_article', 50);
            $table->string('tech_size', 50);
            $table->bigInteger('barcode');
            $table->integer('quantity');
            $table->decimal('total_price', 15, 2);
            $table->date('date_close');
            $table->string('warehouse_name', 100);
            $table->bigInteger('nm_id');
            $table->timestamps();

            $table->index(['date', 'warehouse_name']);
            $table->index('nm_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incomes');
    }
};
