<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mc_applications', function (Blueprint $table) {
            $table->unsignedBigInteger('selected_officer_id')->nullable()->after('status'); // Specify 'after' position if needed
            $table->boolean('direct_admin_approval')->default(false)->after('selected_officer_id'); // Specify 'after' position if needed
            $table->foreign('selected_officer_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('mc_applications', function (Blueprint $table) {
            $table->dropForeign(['selected_officer_id']);
            $table->dropColumn('selected_officer_id');
            $table->dropColumn('direct_admin_approval');
        });
    }
};
