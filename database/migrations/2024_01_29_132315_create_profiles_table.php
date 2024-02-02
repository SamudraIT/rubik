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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('card_number')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('address')->nullable();
            $table->string('place_status')->nullable();
            $table->boolean('healthcare_professional')->default(false);
            $table->foreignId('sub_district_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('hospital_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
