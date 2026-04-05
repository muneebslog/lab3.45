<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('users')->where('role', 'receptionist')->update(['role' => 'staff']);
        DB::table('users')->whereNull('role')->update(['role' => 'admin']);
    }

    public function down(): void
    {
        DB::table('users')->where('role', 'staff')->update(['role' => 'receptionist']);
        DB::table('users')->where('role', 'admin')->update(['role' => null]);
    }
};
