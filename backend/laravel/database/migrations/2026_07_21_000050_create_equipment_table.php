<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->uuid('category_id');
            $table->string('name');
            $table->string('sku')->unique();
            $table->string('serial_number')->nullable()->unique();
            $table->text('description')->nullable();
            $table->unsignedSmallInteger('status_id')->default(1);
            $table->decimal('hourly_rate', 10, 2)->nullable();
            $table->decimal('daily_rate', 10, 2)->nullable();
            $table->decimal('weekly_rate', 10, 2)->nullable();
            $table->decimal('monthly_rate', 10, 2)->nullable();
            $table->date('purchased_at')->nullable();
            $table->date('warranty_expires')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')->references('id')->on('equipment_categories')->onDelete('restrict');
            $table->foreign('status_id')->references('id')->on('equipment_statuses')->onDelete('restrict');
            $table->index('category_id');
            $table->index('status_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};


