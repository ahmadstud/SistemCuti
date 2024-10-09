<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTablesForSelectedOfficer extends Migration
{
    public function up()
    {
        // Drop 'selected_officer_id' column from 'mc_applications' table
        Schema::table('mc_applications', function (Blueprint $table) {
            // Check if the foreign key constraint exists and drop it
            if (Schema::hasColumn('mc_applications', 'selected_officer_id')) {
                $table->dropForeign(['selected_officer_id']); // Drop foreign key constraint if exists
                $table->dropColumn('selected_officer_id'); // Drop the column
            }
        });
    }

    public function down()
    {
        // Re-add 'selected_officer_id' column back to 'mc_applications' table
        Schema::table('mc_applications', function (Blueprint $table) {
            $table->unsignedBigInteger('selected_officer_id')->nullable();
            $table->foreign('selected_officer_id')->references('id')->on('users')->onDelete('set null');
        });
    }
}
