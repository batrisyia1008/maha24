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
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('uniq', 8)->unique()->nullable();
            $table->foreignId('zone_id')->constrained('zones')->onDelete('cascade');
            $table->string('ic_number')->unique();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('state')->nullable();
            $table->string('gender')->nullable();
            $table->longText('know_platform')->nullable();
            $table->string('qr_code')->nullable();
            $table->decimal('total', 10, 2)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};
