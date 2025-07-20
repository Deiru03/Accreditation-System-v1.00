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
            // User Type (Hidden Field for system use)
            $table->enum('user_type', ['iqa', 'validator', 'accreditor', 'uploader'])->default('uploader');
            
            // Employee/Faculty ID (for IQA verification)
            $table->string('employee_id')->nullable()->unique();
            
            // Name fields (replacing single 'name' field approach)
            $table->string('first_name')->after('name');
            $table->string('last_name')->after('first_name');
            $table->string('middle_name')->nullable()->after('last_name');
            
            // Contact Information
            $table->string('phone_number');
            $table->text('address')->nullable();
            
            // System fields for approval process
            $table->enum('status', ['pending', 'active', 'inactive', 'suspended'])->default('pending');
            $table->timestamp('approved_at')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            
            // Tracking fields
            $table->timestamp('last_login_at')->nullable();
            
            // Add foreign key constraint separately
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop foreign key constraint first
            $table->dropForeign(['approved_by']);
            
            // Then drop the columns
            $table->dropColumn([
                'user_type',
                'employee_id', 
                'first_name',
                'last_name',
                'middle_name',
                'phone_number',
                'address',
                'status',
                'approved_at',
                'approved_by',
                'last_login_at'
            ]);
        });
    }
};