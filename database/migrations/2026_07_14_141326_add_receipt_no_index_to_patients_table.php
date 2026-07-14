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
        Schema::table('patients', function (Blueprint $table) {
            // Keep the column as a string so existing values (e.g. "HS-1984") are preserved.
            $table->string('receipt_no', 100)->nullable()->change();
            $table->index('receipt_no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropIndex(['receipt_no']);
            $table->string('receipt_no', 100)->nullable()->change();
        });
    }
};
