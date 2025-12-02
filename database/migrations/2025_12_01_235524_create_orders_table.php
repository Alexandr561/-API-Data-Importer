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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('g_number', 50);
            $table->dateTime('date');  // с временем!
            $table->date('last_change_date');
            $table->string('supplier_article', 50);
            $table->string('tech_size', 50);
            $table->bigInteger('barcode');
            $table->decimal('total_price', 15, 2);
            $table->integer('discount_percent');
            $table->string('warehouse_name', 100);
            $table->string('oblast', 100)->nullable();
            $table->unsignedBigInteger('income_id')->nullable();
            $table->string('odid', 50)->nullable();
            $table->bigInteger('nm_id');
            $table->string('subject', 100);
            $table->string('category', 100)->nullable();
            $table->string('brand', 100)->nullable();
            $table->boolean('is_cancel')->default(false);
            $table->dateTime('cancel_dt')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
