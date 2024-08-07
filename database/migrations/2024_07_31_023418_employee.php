<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Employee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->id()->primary(); 
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->date('date_of_birth');
            $table->string('phone_number', 20); 
            $table->string('email')->unique(); 
            $table->string('province')->nullable();
            $table->string('city', 50)->nullable();
            $table->string('street', 50)->nullable();
            $table->string('zip_code', 10)->nullable();
            $table->string('ktp_number', 16);
            $table->string('ktp_photo')->nullable();
            $table->string('current_position', 50)->nullable();
            $table->string('bank_account', 20)->nullable();
            $table->string('bank_account_number')->nullable();
            $table->timestamp('deleted_at');
            $table->timestamps(); // Created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee');

    }
}
