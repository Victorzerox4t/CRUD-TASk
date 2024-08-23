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
        Schema::create('drink', function (Blueprint $table) {
            $table->integer('id_drink')->autoIncrement();
            $table->string('Drink_Name');
            $table->integer('Qty');
            $table->decimal('Price'); // Adjusting to store decimal values
            $table->longText('Description');
            $table->string('Image');
            $table->timestamps(); // Created_at and updated_at columns

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drink');
    }
};
