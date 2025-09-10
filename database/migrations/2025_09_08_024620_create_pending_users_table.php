<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendingUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pending_users', function (Blueprint $table) {
            $table->id();

            // Basic Information
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('lastname');
            $table->string('suffix')->nullable();
            $table->string('email')->unique();
            $table->date('birthdate');
            $table->string('blood_type', 3);
            $table->string('mobile_no', 20);

            // Government IDs
            $table->string('tin', 50);
            $table->string('gsis', 50);
            $table->string('philhealth', 50);
            $table->string('pagibig', 50);

            // Complete Address
            $table->string('house_no', 50)->nullable();
            $table->string('street')->nullable();
            $table->string('subdivision')->nullable();
            $table->string('province');
            $table->string('city');
            $table->string('barangay');
            $table->string('zip_code', 10)->nullable();

            // Emergency Contact
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_no', 20);
            $table->string('emergency_contact_address');

            // Work Info
            $table->unsignedBigInteger('designation');
            $table->unsignedBigInteger('division');
            $table->unsignedBigInteger('section');
            $table->string('employee_no')->nullable();

            // Account Info
            $table->string('username')->unique();
            $table->string('password'); // hashed
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pending_users');
    }
}
