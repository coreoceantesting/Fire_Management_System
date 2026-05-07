<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('vardi_ahaval_details', function (Blueprint $table) {
            $table->string('reason_of_fire')->nullable()->after('vardi_approximate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vardi_ahaval_details', function (Blueprint $table) {
            $table->dropColumn('reason_of_fire');
        });
    }
};
