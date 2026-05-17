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
        Schema::create('complaint_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('complaint_id')->nullable(); // link to complaint
            $table->string('action'); // e.g. Created, Status Changed, Deleted
            $table->string('status')->nullable(); // Pending, Resolved
            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaint_history');
    }
};
