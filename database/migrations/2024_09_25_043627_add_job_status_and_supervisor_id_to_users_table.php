<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJobStatusAndSupervisorIdToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('job_status')->nullable(); // Adding job_status field
            $table->unsignedBigInteger('supervisor_id')->nullable(); // Adding supervisor_id field

            // Creating a foreign key relationship
            $table->foreign('supervisor_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop foreign key first
            $table->dropForeign(['supervisor_id']);
            // Then drop the columns
            $table->dropColumn(['job_status', 'supervisor_id']);
        });
    }
}

