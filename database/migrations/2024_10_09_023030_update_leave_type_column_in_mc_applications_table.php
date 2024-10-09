<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateLeaveTypeColumnInMcApplicationsTable extends Migration
{
    public function up()
    {
        Schema::table('mc_applications', function (Blueprint $table) {
            // Drop the existing leave_type column
            $table->dropColumn('leave_type');
        });

        Schema::table('mc_applications', function (Blueprint $table) {
            // Add the leave_type column back with ENUM type
            $table->enum('leave_type', ['mc', 'annual', 'other'])->default('mc'); // Set a default value if needed
        });
    }

    public function down()
    {
        Schema::table('mc_applications', function (Blueprint $table) {
            // Drop the leave_type column in case of rollback
            $table->dropColumn('leave_type');
        });

        Schema::table('mc_applications', function (Blueprint $table) {
            // Re-add the leave_type column without ENUM type
            // You can adjust the type as needed
            $table->string('leave_type')->nullable(); // Or whatever type you want for rollback
        });
    }
}
