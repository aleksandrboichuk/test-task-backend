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
        Schema::create('lucky_pages', function (Blueprint $table) {
            $table->id();
            $table->string('hash', 32)->unique();
            $table->unsignedBigInteger('user_id');
            $table->boolean('is_active')->default(true);
            $table->timestamp('expire_at');
            $table->timestamps();

            $table->foreign('user_id')
                ->references("id")
                ->on("users")
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lucky_pages');
    }
};
