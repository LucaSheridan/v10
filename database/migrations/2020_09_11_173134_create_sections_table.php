<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('sections', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            $table->string('title');
            $table->unsignedBigInteger('course_id')->nullable();
            $table->unsignedBigInteger('site_id')->nullable();
            $table->tinyInteger('max_students')->nullable();
            $table->boolean('is_active');
            $table->boolean('is_open');
            $table->string('registrationCode');
            $table->string('year'); 
            $table->timestamps();
            });

            Schema::create('section_user', function (Blueprint $table) {
            
            $table->unsignedBigInteger('section_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('section_id')
                  ->references('id')
                  ->on('sections')
                  ->onDelete('cascade');

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->primary(['section_id', 'user_id']);
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('section_user');
        Schema::dropIfExists('sections');
    }
}
