<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropSupervisorIdFromUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the foreign key first
            $table->dropForeign(['supervisor_id']); // Replace with your foreign key constraint name if needed

            // Now drop the supervisor_id column
            $table->dropColumn('supervisor_id');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Re-add the supervisor_id column
            $table->unsignedBigInteger('supervisor_id')->nullable();

            // Restore the foreign key constraint if necessary
            $table->foreign('supervisor_id')->references('id')->on('supervisors')->onDelete('cascade');
        });
    }
}
