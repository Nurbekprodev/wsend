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

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete()
                ->index();

            $table->string('original_name');
            $table->string('file_path');

            $table->unsignedBigInteger('file_size');

            $table->string('token', 64)->index(); // slightly increased

            $table->timestamp('expires_at')->nullable()->index();

            $table->timestamps();

            $table->unsignedInteger('downloads')->default(0);
            $table->unsignedInteger('max_downloads')->nullable();

            $table->string('password')->nullable();

            $table->string('guest_token', 64)->nullable()->index(); // match generator
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
