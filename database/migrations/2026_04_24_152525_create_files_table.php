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
    Schema::create('files', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
        $table->string('original_name');
        $table->string('file_path');
        $table->bigInteger('file_size');
        $table->string('token');
        $table->timestamp('expires_at')->nullable();
        $table->timestamps();
        $table->integer('downloads')->default(0);
        $table->integer('max_downloads')->nullable();
        $table->string('password')->nullable();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
