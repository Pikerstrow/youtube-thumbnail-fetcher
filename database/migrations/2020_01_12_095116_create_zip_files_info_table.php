<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZipFilesInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zip_files_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('file_name');
            $table->string('path');
            $table->string('url');
            $table->string('youtube_video_id');
            $table->text('thumbnails_info');
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
        Schema::dropIfExists('zip_files_info');
    }
}
