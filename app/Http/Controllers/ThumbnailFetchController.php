<?php

namespace App\Http\Controllers;

use App\Helpers\ExtendedLogging;
use App\HttpClient\ThumbnailFilesFetcher;
use App\ZipFileInfo;
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


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $data = $request->validate([
            'youtube_url' => 'string|max:255|min:30|url'
        ]);

        try {
            $url_get_param = parse_url($data['youtube_url'])['query'];
            $video_id = explode('=', $url_get_param)[1];

            //Check if we already have files. If we have - just return info from db;
            $result = ZipFileInfo::where('youtube_video_id', $video_id)->first();
            if($result) {
                $thumbnails = json_decode($result->thumbnails_info, true);
                $response = [
                    'thumbnails' => $thumbnails,
                    'zip_archive_ur' => $result->url
                ];
                return response()->json($response);
            }

            //Fetch data from YouTube
            $youtube_data = json_decode($this->fetcher->video_id($video_id)->fetch(), true);

            if(isset($youtube_data['items']) && isset($youtube_data['items'][0]) && isset($youtube_data['items'][0]['snippet']) && isset($youtube_data['items'][0]['snippet']['thumbnails'])){
                $thumbnails = $youtube_data['items'][0]['snippet']['thumbnails'];
                $urls = array_column(array_values($thumbnails), 'url');
                $files_fetcher = new ThumbnailFilesFetcher($urls);
                $zip_archive_info = $files_fetcher->fetchFiles();
                $zip_archive_info['youtube_video_id'] = $video_id;
                $zip_archive_info['thumbnails_info'] = json_encode($thumbnails);

                $zip_file_info = ZipFileInfo::create($zip_archive_info);

                $response = [
                    'thumbnails' => $thumbnails,
                    'zip_archive_ur' => $zip_file_info->url
                ];
                return response()->json($response);
            }
            return response()->json([
                'message' => 'Something went wrong or video is not available on YouTube'
            ], Response::HTTP_NO_CONTENT);
        } catch (\Throwable $exception) {
            $this->logError($exception);
            return response()->json([
                'message' => 'Ann error occurred. Please try again later.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
