<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
         Schema::create('collections', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('type')->nullable();
            $table->text('description')->nullable();
            $table->boolean('showArtist');
            $table->boolean('showTitle');
            $table->boolean('showSubtitle');
            $table->boolean('showMedium');
            $table->boolean('showYear');
            $table->boolean('showDimensions');
            $table->boolean('showLabel');
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
        Schema::dropIfExists('collections');
    }
}
