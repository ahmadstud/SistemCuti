<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLeaveTypeColumnToMcApplications extends Migration
{
    public function up()
    {
        Schema::table('mc_applications', function (Blueprint $table) {
            $table->enum('leave_type', ['sick', 'annual'])->after('document_path')->default('sick'); // Default to sick leave
        });
    }

    public function down()
    {
        Schema::table('mc_applications', function (Blueprint $table) {
            $table->dropColumn('leave_type'); // Remove the column if rolling back
        });
    }
}
