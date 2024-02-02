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
        Schema::create('larval_surveillance_records', function (Blueprint $table) {
            $table->id();
            $table->string('reporter_name');
            $table->string('location');
            $table->string('public_facilities')->nullable();
            $table->date('reported_date');
            $table->string('ovitrap_ownership');
            $table->string('image');
            $table->string('reporter_code');
            $table->string('rw');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sub_district_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('larval_surveillance_records');
    }
};
