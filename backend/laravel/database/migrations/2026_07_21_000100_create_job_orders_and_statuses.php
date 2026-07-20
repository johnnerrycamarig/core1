<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_order_statuses', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('code')->unique();
            $table->string('label');
            $table->timestamps();
        });

        Schema::create('job_orders', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->string('order_number')->unique();
            $table->uuid('client_id');
            $table->uuid('project_id')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->timestamp('scheduled_at')->nullable();
            $table->unsignedSmallInteger('status_id')->default(1);
            $table->decimal('total_amount', 14, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('status_id')->references('id')->on('job_order_statuses')->onDelete('restrict');
            $table->index('client_id');
            $table->index('project_id');
            $table->index('status_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_orders');
        Schema::dropIfExists('job_order_statuses');
    }
};


