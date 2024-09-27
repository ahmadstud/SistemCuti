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
            $table->unsignedBigInteger('user_id');  // User who applied for the MC
            $table->date('start_date');
            $table->date('end_date');
            $table->string('reason');
            $table->string('document_path')->nullable();  // Path to uploaded MC document
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');  // Status of the application
            $table->boolean('admin_approved')->default(false);  // Indicates if admin approved
            $table->boolean('officer_approved')->default(false);  // Indicates if officer approved
            $table->boolean('direct_admin_approval')->default(false);  // Direct admin approval flag
            $table->timestamps();

            // Foreign key to reference user table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Foreign key to reference selected officer (optional, if needed)
            $table->foreign('selected_officer_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mc_applications');
    }
};
