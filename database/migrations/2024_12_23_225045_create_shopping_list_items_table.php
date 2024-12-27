<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shopping_list_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shopping_list_id');
            $table->string('description');
            $table->integer('quantity');
            $table->integer('order')->nullable();
            $table->decimal('price', 8, 2);
            $table->boolean('checked')->default(false);
            $table->timestamps();

            $table->foreign('shopping_list_id')
                ->references('id')
                ->on('shopping_lists')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shopping_list_items');
    }
};
