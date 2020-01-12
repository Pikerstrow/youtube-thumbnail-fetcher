<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZipFileInfo extends Model
{
    protected $table = 'zip_files_info';
    protected $fillable = ['file_name', 'path', 'url', 'youtube_video_id', 'thumbnails_info'];
}
