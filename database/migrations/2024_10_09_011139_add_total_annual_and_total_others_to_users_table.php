<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTotalAnnualAndTotalOthersToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('total_annual')->default(0); // Add total_annual column
            $table->integer('total_others')->default(0); // Add total_others column
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['total_annual', 'total_others']); // Remove the columns if the migration is rolled back
        });
    }
}
