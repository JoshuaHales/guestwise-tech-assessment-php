<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->index('name');
            $table->index('brand_id');
            $table->index(['brand_id', 'name']);
        });

        Schema::table('impressions', function (Blueprint $table) {
            $table->index('occurred_at');
            $table->index('campaign_id');
            $table->index(['campaign_id', 'occurred_at']);
        });

        Schema::table('interactions', function (Blueprint $table) {
            $table->index('occurred_at');
            $table->index('campaign_id');
            $table->index(['campaign_id', 'occurred_at']);
        });

        Schema::table('conversions', function (Blueprint $table) {
            $table->index('occurred_at');
            $table->index('campaign_id');
            $table->index(['campaign_id', 'occurred_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropIndex(['name']);
            $table->dropIndex(['brand_id']);
            $table->dropIndex(['brand_id', 'name']);  // Drop compound index
        });

        Schema::table('impressions', function (Blueprint $table) {
            $table->dropIndex(['occurred_at']);
            $table->dropIndex(['campaign_id']);
            $table->dropIndex(['campaign_id', 'occurred_at']);
        });

        Schema::table('interactions', function (Blueprint $table) {
            $table->dropIndex(['occurred_at']);
            $table->dropIndex(['campaign_id']);
            $table->dropIndex(['campaign_id', 'occurred_at']);
        });

        Schema::table('conversions', function (Blueprint $table) {
            $table->dropIndex(['occurred_at']);
            $table->dropIndex(['campaign_id']);
            $table->dropIndex(['campaign_id', 'occurred_at']);
        });
    }
};