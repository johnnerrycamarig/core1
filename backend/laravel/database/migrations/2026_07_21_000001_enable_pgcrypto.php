<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Enable pgcrypto for gen_random_uuid()
        DB::statement('CREATE EXTENSION IF NOT EXISTS "pgcrypto"');
    }

    public function down(): void
    {
        DB::statement('DROP EXTENSION IF EXISTS "pgcrypto"');
    }
};


