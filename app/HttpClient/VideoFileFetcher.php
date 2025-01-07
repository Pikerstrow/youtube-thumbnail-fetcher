<?php

namespace App\HttpClient;

use Exception;

class VideoFileFetcher
{
    protected $fetcher;
    protected $videoUrl;

    public function __construct(string $videoUrl)
    {
        $this->fetcher = new YoutubeDataFetcher();
        $this->videoUrl = $videoUrl;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getVideoInfoForDownloading(): array
    {
        $urlGetParam = parse_url($this->videoUrl)['query'];
        $videoId = explode('=', $urlGetParam)[1];

        $fetchedInfo = $this->fetcher->video_id($videoId)->fetch();

        if (empty($fetchedInfo)) {
            throw new Exception('Error while fetching video info from YouTube server!');
        }

        $videoInfoDecoded = json_decode($fetchedInfo, true);
        $videoInfo = $videoInfoDecoded['items'][0]['snippet'] ?? null;
        if (is_null($videoInfo)) {
            throw new Exception('Error while fetching video info from YouTube server!');
        }
        $result = [
            'title' => $videoInfo['title'] ?? null,
            'links' => []
        ];
        $thumbnails = $videoInfo['thumbnails'] ?? [];
        if (!empty($thumbnails)) {
            $thumbnailsUrls = array_column($thumbnails, 'url');
            $result['image'] = count($thumbnailsUrls) > 1 ? $thumbnailsUrls[1] : $thumbnailsUrls[0];
        }

        return $result;
    }
}
