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
        Schema::create('mst_role', function (Blueprint $table) {
            $table->id();
            $table->string('logical_code', 50)->unique()->comment('ADMIN, PARENT, STUDENT, LIBRARIAN');
            $table->string('role_name', 100)->comment('Human readable role name');
            $table->boolean('is_active')->default(1)->comment('0=Inactive, 1=Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_role');
    }
};
