<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('component_attribute_value', function (Blueprint $table) {
            $table->id();
            $table->foreignId('component_id')
                ->constrained('components')
                ->cascadeOnDelete();
            $table->foreignId('attribute_id')
                ->constrained('component_attributes')
                ->cascadeOnDelete();
            $table->string('value');
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
        Schema::dropIfExists('component_attribute_value');
    }
};
