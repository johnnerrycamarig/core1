<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // This file creates any remaining small tables and pivots if needed

        // Ensure payment/invoice lookups already created by earlier migrations

        // No-op: reserved for future quick pivots or combined cleanups
    }

    public function down(): void
    {
        // No-op
    }
};
