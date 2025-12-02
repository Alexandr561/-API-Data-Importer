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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('g_number', 50);
            $table->date('date');
            $table->date('last_change_date');
            $table->string('supplier_article', 50);
            $table->string('tech_size', 50);
            $table->bigInteger('barcode');
            $table->decimal('total_price', 15, 2);
            $table->integer('discount_percent');
            $table->boolean('is_supply');
            $table->boolean('is_realization');
            $table->string('promo_code_discount', 50)->nullable();
            $table->string('warehouse_name', 100);
            $table->string('country_name', 100);
            $table->string('oblast_okrug_name', 100)->nullable();
            $table->string('region_name', 100)->nullable();
            $table->unsignedBigInteger('income_id')->nullable();
            $table->string('sale_id', 50)->nullable();
            $table->string('odid', 50)->nullable();
            $table->decimal('spp', 5, 2)->nullable();
            $table->decimal('for_pay', 15, 2);
            $table->decimal('finished_price', 15, 2);
            $table->decimal('price_with_disc', 15, 2);
            $table->bigInteger('nm_id');
            $table->string('subject', 100);
            $table->string('category', 100)->nullable();
            $table->string('brand', 100)->nullable();
            $table->boolean('is_storno')->nullable();
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
        Schema::dropIfExists('sales');
    }
};
