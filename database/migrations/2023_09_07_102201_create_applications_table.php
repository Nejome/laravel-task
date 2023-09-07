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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->date('dob');
            $table->string('gender');
            $table->string('nationality');
            $table->string('cv');

            $table->string('coordinator_action')->default('pending');
            $table->string('manager_action')->default('pending');

            $table->foreignId('coordinator_id')->nullable()->constrained('users');
            $table->foreignId('manager_id')->nullable()->constrained('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
