<?php

namespace App\Http\Controllers;

use App\Helpers\ExtendedLogging;
use App\Http\Requests\VideoUrlRequest;
use App\HttpClient\VideoFileFetcher;
use GuzzleHttp\Client;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\JsonResponse;
use Throwable;
use YouTube\YouTubeDownloader;

class VideoFetchController extends Controller
{
    use ExtendedLogging;
    const PART_LENGTH = 2000000;

    /**
     * @param VideoUrlRequest $request
     * @return JsonResponse
     */
    public function index(VideoUrlRequest $request):JsonResponse
    {
        try {
            $youtubeUrl = $request->get('youtube_url');

            //Get video info (thumbnail, title, etc)
            $service = new VideoFileFetcher($youtubeUrl);
            $result = $service->getVideoInfoForDownloading();

            //Get video info
            $youtube = new YouTubeDownloader();
            $downloadOptions = $youtube->getDownloadLinks($request->get('youtube_url'));
            $combinedFormats = $downloadOptions->getCombinedFormats();

            if (!empty($combinedFormats)) {
                foreach ($combinedFormats as $format) {
                    $result['links'][] = [
                        'stream_url' => $format->url,
                        'mime_type' => $format->getCleanMimeType(),
                        'width' => $format->width,
                        'height' => $format->height,
                        'size' => $format->contentLength,
                    ];
                }
            } else {
                $result['links'] = [];
            }

            return \response()->json($result);

//            if (!empty($combinedFormat)) {
//               $this->getVideo($combinedFormat->url, $combinedFormat->contentLength);
//            }
        } catch (Throwable $exception) {
            dd($exception->getMessage());
            $this->logError($exception);
            return response()->json(['message' => 'Ann error occurred. Please try again later.'], \Symfony\Component\HttpFoundation\Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @param $url
     * @param $contentLength
     * @return void
     *
     * Another possible way:
          $pool = new Pool($client, $requests, [
            'concurrency' => '100',
            'fulfilled' => function (Response $response, $index) use ($partLength, $dir) {
                file_put_contents($dir, substr_replace(file_get_contents($dir), $response->getBody(), $index*($partLength+1), 0));
            }
         ]);
     */
    private function getVideo($url, $contentLength = 0)
    {
//        $start = 0;
//        $requests = [];
//        $client = new Client();
//        $dir = 'youtube.mp4';
//
//        for($i = 0; $i < ($contentLength / self::PART_LENGTH); $i++) {
//            $end = ($start + self::PART_LENGTH > $contentLength) ? $contentLength : $start + self::PART_LENGTH;
//            $requests[] = new \GuzzleHttp\Psr7\Request('GET', $url, ($contentLength == 0) ? [] : ['range' => "bytes={$start}-{$end}"]);
//            $start = $start + self::PART_LENGTH + 1;
//        }
//
//        $partLength = self::PART_LENGTH;
//
//        $parts = [];
//        $pool = new Pool($client, $requests, [
//            'concurrency' => '100',
//            'fulfilled' => function (Response $response, $index) use (&$parts) {
//                $parts[$index] = $response->getBody();
//            }
//        ]);
//
//        $pool->promise()->wait();
//        ksort($parts);
//
//        foreach ($parts as $part) {
//            file_put_contents($dir, $part, FILE_APPEND);
//        }
    }

}
