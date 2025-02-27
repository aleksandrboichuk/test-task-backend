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
        Schema::create('lucky_page_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lucky_page_id');
            $table->string('result');
            $table->integer('number');
            $table->integer('sum')->nullable();
            $table->timestamps();

            $table->foreign('lucky_page_id')
                ->references("id")
                ->on("lucky_pages")
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lucky_page_history');
    }
};
