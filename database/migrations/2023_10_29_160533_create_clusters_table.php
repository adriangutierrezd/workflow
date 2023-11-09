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
        Schema::create('clusters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('owner_id')->constrained(table: 'users', indexName: 'cluster_owner_id');
            $table->foreignId('workout_id')->constrained()->onDelete('cascade');
            $table->foreignId('excercise_id')->constrained();
            $table->unsignedTinyInteger('sets');
            $table->unsignedSmallInteger('reps');
            $table->float('weight', 7, 2);
            $table->string('unit'); // A futuro convertir esto en ENUM (kg, lb, etc)
            $table->boolean('done')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clusters');
    }
};
