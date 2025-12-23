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
        Schema::table('male_rescuers_details', function (Blueprint $table) {
            $table->string('male_age')->nullable()->after('male_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('male_rescuers_details', function (Blueprint $table) {
            $table->dropColumn('male_age');
        });
    }
};
