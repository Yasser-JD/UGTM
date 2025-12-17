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
            if (!Schema::hasColumn('users', 'rental_number')) {
                $table->string('rental_number')->unique()->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'province')) {
                $table->string('province')->default('Larache')->after('email');
            }
            if (!Schema::hasColumn('users', 'commune')) {
                $table->string('commune')->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'workplace')) {
                $table->string('workplace')->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'job_title')) {
                $table->string('job_title')->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'is_active')) {
                $table->boolean('is_active')->default(false)->after('email');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'rental_number',
                'phone',
                'province',
                'commune',
                'workplace',
                'job_title',
                'is_active',
            ]);
        });
    }
};
