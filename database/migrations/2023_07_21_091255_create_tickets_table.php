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
            $table->enum('status',['unknow', 'active', 'inactive']);
            $table->unsignedBigInteger('category_id')->nullable();
            $table->index('category_id', 'ticket_category_idx');
            $table->foreign('category_id', 'ticket_category_fk')->on('categories')->references('id');
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
