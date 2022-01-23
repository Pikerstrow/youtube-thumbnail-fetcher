<?php

namespace App\Http\Controllers;

use App\ZipFileInfo;
use Illuminate\Http\Request;

class ZipArchivesController extends Controller
{
    public function index(Request $request, ZipFileInfo $archive)
    {
        $time = substr($archive->file_name, $start = (strpos($archive->file_name, '_') + 1), (strpos($archive->file_name, '.') - $start));
        if(time() > (int)$time ){
            abort(404);
            return;
        }

        $archive_path = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'zip' . DIRECTORY_SEPARATOR . $archive->file_name);

        if(file_exists($archive_path)){
            $headers = array(
                'Content-Type: application/zip',
            );
            return response()->download($archive_path, 'thumbnails.zip', $headers);
        }
        abort(404);
    }
}
