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
        Schema::create('page_visits', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->index();
            $table->string('path');
            $table->string('page_type')->nullable();
            $table->unsignedBigInteger('page_id')->nullable();
            $table->string('referrer')->nullable();
            $table->timestamps();
            $table->index([
                'page_type',
                'page_id',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_visits');
    }
};
