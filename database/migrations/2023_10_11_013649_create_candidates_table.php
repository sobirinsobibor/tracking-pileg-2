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
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->char('candidate_artificial_id', 7)->unique()->nullable(false);
            $table->char('candidate_encrypted_id', 16)->unique()->nullable(false);
            $table->string('candidate_name', 100)->nullable(false);
            $table->boolean('candidate_gender')->nullable(false);
            $table->string('candidate_address', 50)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
