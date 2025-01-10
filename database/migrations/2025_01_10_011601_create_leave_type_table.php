<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveTypeTable extends Migration
{
    public function up()
    {
        Schema::create('leave_type', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Name of the leave type
            $table->text('content')->nullable(); // Description of the leave type
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('leave_type');
    }
}
