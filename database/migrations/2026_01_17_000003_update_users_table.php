<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->text('address')->nullable()->after('phone');
            $table->string('department')->nullable()->after('address');
            $table->enum('role', ['Admin', 'Manager', 'Staff'])->default('Admin')->after('department');
            $table->string('avatar')->nullable()->after('role');
            $table->enum('status', ['Active', 'Inactive'])->default('Active')->after('avatar');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->dropColumn('address');
            $table->dropColumn('department');
            $table->dropColumn('role');
            $table->dropColumn('avatar');
            $table->dropColumn('status');
        });
    }
};
