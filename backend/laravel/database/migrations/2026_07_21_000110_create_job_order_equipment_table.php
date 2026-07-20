<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_order_equipment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('job_order_id');
            $table->uuid('equipment_id');
            $table->integer('quantity')->default(1);
            $table->decimal('rate', 10, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('job_order_id')->references('id')->on('job_orders')->onDelete('cascade');
            $table->foreign('equipment_id')->references('id')->on('equipment')->onDelete('restrict');
            $table->index('job_order_id');
            $table->index('equipment_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_order_equipment');
    }
};
