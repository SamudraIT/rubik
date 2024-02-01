<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dengue_case_tables', function (Blueprint $table) {
            $table->id();
            $table->string('district');
            $table->string('sub_district');
            $table->string('rw');
            $table->foreignId('dengue_case_report_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dengue_case_tables');
    }
};
