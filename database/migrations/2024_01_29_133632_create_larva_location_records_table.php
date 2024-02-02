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
        Schema::create('larva_location_records', function (Blueprint $table) {
            $table->id();
            $table->string('larva_location');
            $table->string('status');
            $table->string('reporter_code');
            $table->foreignId('larval_surveillance_record_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('larva_location_records');
    }
};
