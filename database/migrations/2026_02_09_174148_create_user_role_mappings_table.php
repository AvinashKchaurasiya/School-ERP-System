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
        Schema::create('mst_user_role_mapping', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->comment('User ID from users table');
            $table->foreignId('role_id')->constrained('mst_role')->comment('Role ID from mst_role table');
            $table->boolean('is_active')->default(1)->comment('0=Inactive, 1=Active');
            $table->timestamps();
            $table->index(['user_id', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_user_role_mapping');
    }
};
