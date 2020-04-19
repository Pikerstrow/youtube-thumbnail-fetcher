<?php
return [
    'title' => 'Get YouTube Video Preview Image',
    'h1' => 'Get YouTube Video Preview Image',
    'description' => 'The simplest and the most fast way to retrieve preview image for YouTube videos. Just paste URL of the video in the input below and press the button. As a result, you\'ll get links to thumbnail in all available resolutions and link to the zip archive with files.',
    'note' => 'Note: ',
    'note_txt' => 'supported URL format: https://www.youtube.com/watch?v=XvtrI5hOIij7',
    'result_title' => 'Max resolution thumbnail image for YouTube video by provided URL is',
    'links_note' => ' You can download this image by right click of the mouse or use links below. Also you can download zip archive with images of all available resolutions.',
    'h3_links' => 'Links for thumbnails with different resolutions',
    'h3_zip' => 'Link for zip archive with all thumbnails',
    'resolution' => 'Resolution',
    'link' => 'Link',
    'archive_note' => 'Please, pay attention, that link for zip archive is valid only or 24 hours.',
    'clear' => 'Clear',
    'fetch' => 'Fetch Image',
    'not_found' => 'Page not found',
    'to_main' => 'To Main Page',
    'meta_description' => 'YouTube Thumbnails Image Picker is a free service for getting thumbnails (images) in all available resolutions from Youtube videos by url.',
    'meta_keywords' => 'Youtube video image picker, get youtube thumbnail, youtube video thumbnail',
    'faq' => 'FAQ',
    'questions' => [
        '1' => [
            'question' => 'What is Thumbnail Image?',
            'response' => 'A Thumbnail on YouTube is an image whose main purpose is to transfer contents of the video to users and attract their attention. In other words, this is what the users see firstly. A Thumbnail can be created automatically from video (one of the frames). But, most often, the user who uploads the video creates it on his own, as this is a very important element in promoting the video.'
        ],
        '2' => [
            'question' => 'Is there any requirements to Thumbnail Image on YouTube?',
            'response' => 'Yes. According to official documentation preview image should be as large as possible, due to different type of devices which can be used for viewing YouTube. The recommendations are next:',
            'requirements' => [
                'dimensions' => '1280x720 resolution (with minimum width of 640 pixels)',
                'format' => 'JPG, GIF, BMP, or PNG image formats',
                'size' => 'less than 2 MB',
                'aspect_ratio' => '16 : 9 aspect ratio'
            ]
        ],
        '3' => [
            'question' => 'Is it possible to get (fetch) Thumbnail Image of the YouTube video?',
            'response' => 'Yes. All you need is to find video on YouTube from which you want to get preview image, copy its URL, paste it in the input above and press \'Fetch Image\' button. After that you\'ll get links to the thumbnail in all possible resolutions and link for downloading zip archive file with image (with all available dimensions).'
        ],
        '4' => [
            'question' => 'For how long links for thumbnail image from response are valid?',
            'response' => 'Link for zip archive is valid during the next 24 hours after generating. What about links from YouTube, as a rule, they are valid while video is available on site.'
        ]
    ]
];
