<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSelectedOfficerIdToMcApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('mc_applications', function (Blueprint $table) {
            $table->unsignedBigInteger('selected_officer_id')->nullable()->after('user_id'); // Adjust based on your table structure

            // Optional: Add a foreign key constraint if desired
            $table->foreign('selected_officer_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mc_applications', function (Blueprint $table) {
            $table->dropForeign(['selected_officer_id']); // Drop foreign key if it exists
            $table->dropColumn('selected_officer_id'); // Remove the column
        });
    }
}
