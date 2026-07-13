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
        Schema::table('patient_test', function (Blueprint $table) {
            $table->timestamp('printed_at')->nullable()->after('isPrinted');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patient_test', function (Blueprint $table) {
            $table->dropColumn('printed_at');
        });
    }
};
