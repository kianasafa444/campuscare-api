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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');

            $table->string('title');
            $table->text('description');
            $table->string('location');
            $table->string('photo')->nullable();

            $table->enum('priority', ['low', 'medium', 'high', 'critical'])->nullable();

            $table->enum('status', ['pending', 'verified', 'assigned', 'in_progress', 'completed', 'reopened', 'closed', 'rejected'])->default('pending');

            $table->unsignedBigInteger('verified_by')->nullable();
            $table->timestamp('verified_at')->nullable();

            $table->timestamps();
        });
    }
};
