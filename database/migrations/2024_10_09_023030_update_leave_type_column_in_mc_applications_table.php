<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateLeaveTypeColumnInMcApplicationsTable extends Migration
{
    public function up()
    {
        // Check if the column exists before trying to drop it
        Schema::table('mc_applications', function (Blueprint $table) {
            if (Schema::hasColumn('mc_applications', 'leave_type')) {
                // Drop the existing leave_type column
                $table->dropColumn('leave_type');
            }

            // Add the leave_type column back with ENUM type
            $table->enum('leave_type', ['mc', 'annual', 'other'])->default('mc');
        });
    }

    public function down()
    {
        Schema::table('mc_applications', function (Blueprint $table) {
            if (Schema::hasColumn('mc_applications', 'leave_type')) {
                // Drop the leave_type column in case of rollback
                $table->dropColumn('leave_type');
            }

            // Re-add the leave_type column with string type
            $table->string('leave_type')->nullable();
        });
    }
}
