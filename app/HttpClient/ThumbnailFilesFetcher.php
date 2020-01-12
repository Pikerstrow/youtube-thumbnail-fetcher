<?php


namespace App\HttpClient;


use Illuminate\Support\Facades\Storage;
use ZipArchive;


class ThumbnailFilesFetcher
{
    protected $urls;


    public function __construct(array $urls)
    {
        $this->urls = $urls;
    }


    /**
     * @param string $url
     * @throws \Exception
     */
    private function downloadFile(string $url)
    {
        $url_parts = explode('/', $url);
        $image_name = array_pop($url_parts);
        $resource = curl_init($url);
        curl_setopt($resource, CURLOPT_VERBOSE, 1);
        curl_setopt($resource, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($resource, CURLOPT_AUTOREFERER, false);
        curl_setopt($resource, CURLOPT_REFERER, "https://i.ytimg.com");
        curl_setopt($resource, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($resource, CURLOPT_HEADER, 0);
        $result = curl_exec($resource);
        curl_close($resource);

        if ($result) {
            Storage::put("public/tmp/$image_name", $result);
        } else {
            throw new \Exception('Download failed');
        }
    }


    public function fetchFiles()
    {
        try {
            //Download files and put them in tmp folder
            foreach($this->urls as $url){
                $this->downloadFile($url);
            }
            //Make zip archive
            $zip = new ZipArchive();
            $valid_to = time() + 86400;
            $archive_name = 'thumbnails_' . $valid_to . '.zip';

            $path = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'zip' . DIRECTORY_SEPARATOR . $archive_name);
            touch($path);
            if ($zip->open($path, ZipArchive::CREATE) === TRUE) {
                $files = Storage::allFiles('public\tmp');
                foreach ($files as $key => $value) {
                    $name_in_zip_file = basename($value);
                    $zip->addFile(storage_path('app' . DIRECTORY_SEPARATOR . $value), $name_in_zip_file);
                }
                $zip->close();
                Storage::delete($files);

                //For storing data about zip archive in DB (for CRON jobs)
                $zip_archive_info = [
                    'file_name' => $archive_name,
                    'path' => $path,
                    'url' => route('archive', ['archive' => $archive_name])
                ];

                return $zip_archive_info;
            } else {
                throw new \Exception('Creating archive failed');
            }
        } catch (\Throwable $e) {
            throw new \Exception('Download failed');
        }
    }

}
