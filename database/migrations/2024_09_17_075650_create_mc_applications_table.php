<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mc_applications', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('user_id');
    $table->date('start_date');
    $table->date('end_date');
    $table->string('reason');
    $table->string('document_path')->nullable();
    $table->string('status')->default('pending');
    $table->timestamps();

    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
});
    }

    public function down(): void
    {
        Schema::dropIfExists('mc_applications');
    }
};
