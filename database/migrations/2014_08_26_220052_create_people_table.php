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
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('identifier_type')->nullable();
            $table->string('identifier')->nullable();
            $table->string('name');
            $table->string('lastname');
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('zip_code', 6)->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('country_id')->nullable();
            $table->string('email');
            $table->enum('gender',[0,1,2])->default(0);
            $table->enum('marital_status',[0,1,2,3,4,5,6])->default(0);
            $table->date('birthdate')->nullable();
            $table->string('photo')->nullable();
            $table->string('job_position')->nullable();
            $table->string('title')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
