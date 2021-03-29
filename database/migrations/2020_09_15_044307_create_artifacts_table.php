<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtifactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artifacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('component_id')->nullable();
            $table->string('assignment_id')->nullable();
            $table->string('section_id')->nullable();
            $table->string('artifact_path');
            $table->string('artifact_thumb');
            $table->text('annotation', 750)->nullable();
            $table->string('artist')->nullable();
            $table->string('title')->nullable();
            $table->string('medium')->nullable();
            $table->string('year')->nullable();
            
            $table->string('dimensions_height_pixels')->nullable();
            $table->string('dimensions_width_pixels')->nullable();

            $table->string('dimensions_height')->nullable();
            $table->string('dimensions_width')->nullable();
            $table->string('dimensions_depth')->nullable();
            $table->string('dimensions_units')->nullable();
            $table->boolean('is_published');
            $table->boolean('is_public');
            $table->boolean('from_URL')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('artifacts');
    }
}
