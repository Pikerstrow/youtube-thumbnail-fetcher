<?php

namespace App\HttpClient;



use Exception;
use Throwable;

class YoutubeDataFetcher
{
    protected $resource;
    protected $api_key;
    protected $base_url;

    /**
     * HttpClient constructor.
     */
    public function __construct()
    {
        $this->resource = curl_init();
        $this->api_key  = 'AIzaSyCsdsOGHaALxh6IuOfKsQgtAbAyAEThZec';
        $this->base_url = 'https://www.googleapis.com/youtube/v3/videos';
    }

    /**
     * @param string $id
     * @return $this
     */
    public function video_id(string $id)
    {
        $url = $this->build_url($id);
        curl_setopt($this->resource, CURLOPT_URL, $url);
        return $this;
    }


    /**
     * void
     */
    private function prepare(): void
    {
        curl_setopt($this->resource, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($this->resource, CURLOPT_RETURNTRANSFER, 1);
    }


    /**
     * @param string $id
     * @return string
     */
    private function build_url(string $id)
    {
        return $this->base_url . '?key=' . $this->api_key . '&part=snippet&id=' . $id;
    }


    /**
     * @return bool|string
     * @throws Exception
     */
    public function fetch()
    {
        try {
            $this->prepare();
            $data = curl_exec($this->resource);
            if(!$data){
                throw new Exception('Error in fetching data from YouTube. Error ' . curl_error($this->resource));
            }
            return $data;
        } catch (Throwable $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}
