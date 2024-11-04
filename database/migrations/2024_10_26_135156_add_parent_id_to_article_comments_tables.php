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
        Schema::table('article_comments', function (Blueprint $table) {
            $table->foreignUuid('parent_id')->nullable()
                ->constrained('article_comments') // Reference the same table
                ->onDelete('cascade');
        });
    }
};
