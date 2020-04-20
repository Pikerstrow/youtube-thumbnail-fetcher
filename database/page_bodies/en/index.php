<?php
$body = <<<BODY
<section class="faq-section">
<div class="wrap-container">
<h2>FAQ</h2>
<article class="question-container">
<h4 class="question">What is Thumbnail Image?</h4>
<p>A Thumbnail on YouTube is an image whose main purpose is to transfer contents of the video to users and attract their attention. In other words, this is what the users see firstly. A Thumbnail can be created automatically from video (one of the frames). But, most often, the user who uploads the video creates it on his own, as this is a very important element in promoting the video.</p>
</article>
<article class="question-container">
<h4 class="question">Is there any requirements to Thumbnail Image on YouTube?</h4>
<div class="li-container">
<p>Yes. According to official documentation preview image should be as large as possible, due to different type of devices which can be used for viewing YouTube. The recommendations are next:</p>
<ul>
<li>1280x720 resolution (with minimum width of 640 pixels)</li>
<li>JPG, GIF, BMP, or PNG image formats</li>
<li>less than 2 MB</li>
<li>16 : 9 aspect ratio</li>
</ul>
</div>
</article>
<article class="question-container">
<h4 class="question">Is it possible to get (fetch) Thumbnail Image of the YouTube video?</h4>
<p>Yes. All you need is to find video on YouTube from which you want to get preview image, copy its URL, paste it in the input above and press &#039;Fetch Image&#039; button. After that you&#039;ll get links to the thumbnail in all possible resolutions and link for downloading zip archive file with image (with all available dimensions).</p>
</article>
<article class="question-container">
<h4 class="question">For how long links for thumbnail image from response are valid?</h4>
<p>Link for zip archive is valid during the next 24 hours after generating. What about links from YouTube, as a rule, they are valid while video is available on site.</p>
</article>
</div>
</section>
BODY;

return $body;

