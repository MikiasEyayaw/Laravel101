<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->boolean('is_approved')->default(true)->after('description');
            $table->text('rejection_reason')->nullable()->after('is_approved');
            $table->timestamp('approved_at')->nullable()->after('rejection_reason');
            $table->timestamp('featured_until')->nullable()->after('approved_at');
        });
    }

    public function down(): void
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->dropColumn(['is_approved', 'rejection_reason', 'approved_at', 'featured_until']);
        });
    }
};
