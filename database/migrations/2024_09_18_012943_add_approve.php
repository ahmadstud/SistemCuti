<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mc_applications', function (Blueprint $table) {
            $table->boolean('officer_approved')->default(false); // Add this column
            $table->boolean('admin_approved')->default(false);   // Also add admin approval
        });
    }

    public function down(): void
    {
        Schema::table('mc_applications', function (Blueprint $table) {
            $table->dropColumn('officer_approved');
            $table->dropColumn('admin_approved');
        });
    }
};
