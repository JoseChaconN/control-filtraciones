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
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('area_id')->nullable();
            $table->string('code', 100)->nullable();
            $table->string('name', 100)->nullable();
            $table->text('description')->nullable();
            $table->integer('status')->nullable();
            $table->decimal('regular_flow', 10, 4)->nullable();
            $table->decimal('peak_flow', 10, 4)->nullable();
            $table->decimal('minimum_flow', 10, 4)->nullable();
            $table->dateTime('last_connection')->nullable();
            $table->text('token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
