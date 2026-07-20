<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rental_statuses', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('code')->unique();
            $table->string('label');
            $table->timestamps();
        });

        Schema::create('rentals', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->string('rental_number')->unique();
            $table->uuid('client_id');
            $table->uuid('project_id')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedSmallInteger('status_id')->default(1);
            $table->decimal('total_amount', 14, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('status_id')->references('id')->on('rental_statuses')->onDelete('restrict');
            $table->index('client_id');
            $table->index('project_id');
            $table->index('status_id');
            $table->check('end_date >= start_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rentals');
        Schema::dropIfExists('rental_statuses');
    }
};


