<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('is_approved');
            $table->text('rejection_reason')->nullable()->after('is_active');
            $table->timestamp('approved_at')->nullable()->after('rejection_reason');
            $table->timestamp('deactivated_at')->nullable()->after('approved_at');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['is_active', 'rejection_reason', 'approved_at', 'deactivated_at']);
        });
    }
};
