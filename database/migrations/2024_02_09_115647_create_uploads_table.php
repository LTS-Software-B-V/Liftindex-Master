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
        Schema::create('uploads', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->nullable();    
            $table->integer('category_id')->nullable();    
            $table->string('filename')->nullable();   
            $table->string('directory')->nullable();   
            $table->integer('incident_id')->nullable();   
            $table->integer('project_id')->nullable();   
            $table->integer('customer_id')->nullable();   
            $table->string('image')->nullable();    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uploads');
    }
};
