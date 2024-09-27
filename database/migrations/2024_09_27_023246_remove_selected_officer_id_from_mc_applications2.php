<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveSelectedOfficerIdFromMcApplications2 extends Migration
{
    public function up(): void
    {
        Schema::table('mc_applications', function (Blueprint $table) {
            $table->dropForeign(['selected_officer_id']); // Drop foreign key if it exists
            $table->dropColumn('selected_officer_id'); // Drop the column
        });
    }

    public function down(): void
    {
        Schema::table('mc_applications', function (Blueprint $table) {
            $table->unsignedBigInteger('selected_officer_id')->nullable(); // Re-add the column
            $table->foreign('selected_officer_id')->references('id')->on('users')->onDelete('set null'); // Re-add foreign key
        });
    }
}
