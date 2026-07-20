<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('equipment_maintenance', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('equipment_id');
            $table->unsignedSmallInteger('maintenance_type_id')->nullable();
            $table->bigInteger('performed_by')->unsigned()->nullable();
            $table->timestamp('scheduled_at')->nullable();
            $table->timestamp('performed_at')->nullable();
            $table->text('notes')->nullable();
            $table->decimal('cost', 12, 2)->nullable();
            $table->timestamp('next_due_at')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('equipment_id')->references('id')->on('equipment')->onDelete('cascade');
            $table->foreign('performed_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->index('equipment_id');
        });

        Schema::create('maintenance_types', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('code')->unique();
            $table->string('label');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenance_types');
        Schema::dropIfExists('equipment_maintenance');
    }
};
