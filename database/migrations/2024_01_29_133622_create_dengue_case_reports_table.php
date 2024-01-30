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
        Schema::create('dengue_case_reports', function (Blueprint $table) {
            $table->id();
            $table->string('patient_name');
            $table->string('patient_status');
            $table->string('report_status');
            $table->string('diseases_symptom');
            $table->string('phone_number');
            $table->date('confirmation_date');
            $table->date('recovery_date');
            $table->foreignId('hospital_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('district_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dengue_case_reports');
    }
};
