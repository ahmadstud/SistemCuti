<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTablesForSelectedOfficer extends Migration
{
    public function up()
    {
        // Add 'selected_officer_id' column to 'users' table
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('selected_officer_id')->nullable()->after('profile_image');
            $table->foreign('selected_officer_id')->references('id')->on('users')->onDelete('set null');
        });

        // Drop 'selected_officer_id' column from 'mc_applications' table
        Schema::table('mc_applications', function (Blueprint $table) {
            $table->dropColumn('selected_officer_id');
        });
    }

    public function down()
    {
        // Drop 'selected_officer_id' column from 'users' table
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['selected_officer_id']);
            $table->dropColumn('selected_officer_id');
        });

        // Add 'selected_officer_id' column back to 'mc_applications' table
        Schema::table('mc_applications', function (Blueprint $table) {
            $table->unsignedBigInteger('selected_officer_id')->nullable();
            $table->foreign('selected_officer_id')->references('id')->on('users')->onDelete('set null');
        });
    }
}
