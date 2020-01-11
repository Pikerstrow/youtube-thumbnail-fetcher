<?php

namespace App\Http\Controllers;

use App\Helpers\ExtendedLogging;
use App\HttpClient\ThumbnailFilesFetcher;
use Illuminate\Http\Request;
use App\HttpClient\YoutubeDataFetcher;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class ThumbnailFetchController extends Controller
{
    use ExtendedLogging;

    protected $fetcher;


    public function __construct(YoutubeDataFetcher $fetcher)
    {
        $this->fetcher = $fetcher;
    }



    public function index(Request $request)
    {
        $data = $request->validate([
            'youtube_url' => 'string|max:255|min:30|url'
        ]);

        try {
            $response = [];
            $url_get_param = parse_url($data['youtube_url'])['query'];
            $video_id = explode('=', $url_get_param)[1];
            $youtube_data = json_decode($this->fetcher->video_id($video_id)->fetch(), true);

            if(isset($youtube_data['items']) && isset($youtube_data['items'][0]) && isset($youtube_data['items'][0]['snippet']) && isset($youtube_data['items'][0]['snippet']['thumbnails'])){
                $thumbnails = $youtube_data['items'][0]['snippet']['thumbnails'];
                $response['thumbnails'] = $thumbnails;

                $urls = array_column(array_values($thumbnails), 'url');
                $files_fetcher = new ThumbnailFilesFetcher($urls);
                $zip_url = $files_fetcher->fetchFiles();
                $response['zip_archive_url'] = asset($zip_url);
                dd($response);
            }



        } catch (\Throwable $exception) {
            $this->logError($exception);
            return response()->json([
                'message' => 'Ann error occurred. Please try again later.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
