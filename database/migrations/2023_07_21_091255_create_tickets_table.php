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
        Schema::create('tickets', function(Blueprint $table){
            $table->id();
            $table->string('name_project', 50);
            $table->string('name_of_the_manager', 50);
            $table->char('email_of_the_manager',50)->nullable();
            $table->date('start_date_of_execution')->nullable();
            $table->enum('status',['unkow', 'active', 'inactive']);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
