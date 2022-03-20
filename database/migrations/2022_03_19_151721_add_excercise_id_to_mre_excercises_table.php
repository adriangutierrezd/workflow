<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExcerciseIdToMreExcercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mre_excercises', function (Blueprint $table) {
            $table->unsignedBigInteger('excercise_id')->nullable();
            $table->foreign('excercise_id')->references('id')->on('excercises')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mre_excercises', function (Blueprint $table) {
            $table->dropColumn('excercise_id');
        });
    }
}
