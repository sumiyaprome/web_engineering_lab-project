<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('ALTER TABLE `users` MODIFY `password` VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE `users` MODIFY `contact` VARCHAR(25) NOT NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE `users` MODIFY `password` VARCHAR(16) NOT NULL');
        DB::statement('ALTER TABLE `users` MODIFY `contact` BIGINT NOT NULL');
    }
};
