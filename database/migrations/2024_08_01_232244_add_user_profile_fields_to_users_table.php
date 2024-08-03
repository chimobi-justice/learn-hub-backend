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
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable()->unique()->after('email');
            $table->string('twitter')->nullable()->after('username');
            $table->string('avatar')->nullable()->after('twitter');
            $table->string('gitHub')->nullable()->after('twitter');
            $table->string('website')->nullable()->after('gitHub');
            $table->text('profile_headlines')->nullable()->after('website');
            $table->text('bio')->nullable()->after('profile_headlines');
            $table->string('state')->nullable()->after('bio');
            $table->string('country')->nullable()->after('state');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'username',
                'twitter',
                'avatar',
                'gitHub',
                'website',
                'profile_headlines',
                'bio',
                'state',
                'country'
            ]);
        });
    }
};
