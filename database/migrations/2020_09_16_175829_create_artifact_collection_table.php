<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtifactCollectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('artifact_collection', function (Blueprint $table) {
            $table->bigInteger('collection_id')->unsigned();
            $table->bigInteger('artifact_id')->unsigned();
            $table->bigInteger('position')->unsigned();
            $table->string('artist')->nullable();
            $table->string('title')->nullable();
            $table->string('medium')->nullable();
            $table->string('year')->nullable();
            $table->string('dimensions_height')->nullable();
            $table->string('dimensions_width')->nullable();
            $table->string('dimensions_depth')->nullable();
            $table->string('dimensions_units')->nullable();
            $table->text('label_text', 750)->nullable();

            $table->foreign('collection_id')
                  ->references('id')
                  ->on('collections')
                  ->onDelete('cascade');

            $table->foreign('artifact_id')
                  ->references('id')
                  ->on('artifacts')
                  ->onDelete('cascade');

           });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artifact_collection');
    }
}
