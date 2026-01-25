<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->dropColumn('text');
        });

        Schema::table('life_sections', function (Blueprint $table) {
            $table->dropColumn(['title', 'content']);
        });

        Schema::table('works', function (Blueprint $table) {
            $table->dropColumn(['title', 'short_description', 'main_content', 'spiritual_value']);
        });

        Schema::table('paths', function (Blueprint $table) {
            $table->dropColumn(['title', 'content']);
        });

        Schema::table('studies', function (Blueprint $table) {
            $table->dropColumn(['title', 'content']);
        });

        Schema::table('tests', function (Blueprint $table) {
            $table->dropColumn('title');
        });

        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn(['question', 'options']);
        });
    }

    public function down(): void
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->json('text')->nullable();
        });

        Schema::table('life_sections', function (Blueprint $table) {
            $table->json('title')->nullable();
            $table->json('content')->nullable();
        });

        Schema::table('works', function (Blueprint $table) {
            $table->json('title')->nullable();
            $table->json('short_description')->nullable();
            $table->json('main_content')->nullable();
            $table->json('spiritual_value')->nullable();
        });

        Schema::table('paths', function (Blueprint $table) {
            $table->json('title')->nullable();
            $table->json('content')->nullable();
        });

        Schema::table('studies', function (Blueprint $table) {
            $table->json('title')->nullable();
            $table->json('content')->nullable();
        });

        Schema::table('tests', function (Blueprint $table) {
            $table->json('title')->nullable();
        });

        Schema::table('questions', function (Blueprint $table) {
            $table->json('question')->nullable();
            $table->json('options')->nullable();
        });
    }
};
