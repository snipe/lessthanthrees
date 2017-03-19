<!-- ads here -->



<div class="navbar navbar-static-top subnav" role="navigation">
    <div class="navbar-inner">
        <div class="container ad-text text-center">

@if (isset($category))

    @if ($category->slug=='music')

        <div class="col-md-2 col-xs-4 text-right">
            <a target="_blank" href="https://www.amazon.com/gp/dmusic/promotions/AmazonMusicUnlimited?ref_=assoc_tag_ph_1483579440886&_encoding=UTF8&camp=1789&creative=9325&linkCode=pf4&tag={{ config('services.affiliate.amazon') }}&linkId=b72f803fd78bba6fa3d61dac98b715c0">
            <img src="{{ config('app.url') }}/img/music.png" style="height: 25px; width: auto; padding-right: 15px;"></a>

        </div>
        <div class="col-md-10 col-xs-8 text-left">

            <a target="_blank" href="https://www.amazon.com/gp/dmusic/promotions/AmazonMusicUnlimited?ref_=assoc_tag_ph_1483579440886&_encoding=UTF8&camp=1789&creative=9325&linkCode=pf4&tag=lessthanthrees-20&linkId=b72f803fd78bba6fa3d61dac98b715c0">

                Try Amazon Music Unlimited 30-Day Free Trial!</a>
            <img src="//ir-na.amazon-adsystem.com/e/ir?t=lessthanthrees-20&l=pf4&o=1" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important;" /></p>
        </div>

    @elseif ($category->slug=='books')
        <div class="col-md-2 col-xs-4 text-right">
            <a target="_blank" href="https://www.amazon.com/associates/AppDownload?program=1&ref_=assoc_tag_ph_1402131685749&_encoding=UTF8&camp=1789&creative=9325&linkCode=pf4&tag={{ config('services.affiliate.amazon') }}&linkId=8aff2f455941b7a613008402234ae2dc">
                <img src="{{ config('app.url') }}/img/kindle.png" style="height: 25px; width: auto; padding-right: 15px;"></a>

        </div>
        <div class="col-md-10 col-xs-8 text-left">

            <a target="_blank" href="https://www.amazon.com/associates/AppDownload?program=1&ref_=assoc_tag_ph_1402131685749&_encoding=UTF8&camp=1789&creative=9325&linkCode=pf4&tag={{ config('services.affiliate.amazon') }}&linkId=8aff2f455941b7a613008402234ae2dc">

                Read eBooks using the FREE Kindle Reading App on Most Devices</a>
            <img src="//ir-na.amazon-adsystem.com/e/ir?t=lessthanthrees-20&l=pf4&o=1" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important;" /></p>
        </div>

    @else


        <div class="col-md-2 col-xs-4 text-right">
            <a target="_blank" href="https://www.amazon.com/gp/video/primesignup?ref_=assoc_tag_ph_1402131641212&_encoding=UTF8&camp=1789&creative=9325&linkCode=pf4&tag={{ config('services.affiliate.amazon') }}&linkId=cd36abf3f3f5a0196847fdfc25efe942"><img src="{{ config('app.url') }}/img/amazon-prime-video.png" style="height: 25px; width: auto; padding-right: 15px;"></a>

        </div>
        <div class="col-md-10 col-xs-8 text-left">

            <a target="_blank" href="https://www.amazon.com/gp/video/primesignup?ref_=assoc_tag_ph_1402131641212&_encoding=UTF8&camp=1789&creative=9325&linkCode=pf4&tag={{ config('services.affiliate.amazon') }}&linkId=cd36abf3f3f5a0196847fdfc25efe942">

                <span class="hidden-xs"> Watch Thousands of Movies &amp; TV Shows Anytime!</span>

                Start Your Free Amazon Prime Video Trial Now!</a>
            <img src="//ir-na.amazon-adsystem.com/e/ir?t=lessthanthrees-20&l=pf4&o=1" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important;" /></p>
        </div>

    @endif



@else


            <div class="col-md-2 col-xs-4 text-right">
                <a target="_blank" href="https://www.amazon.com/gp/video/primesignup?ref_=assoc_tag_ph_1402131641212&_encoding=UTF8&camp=1789&creative=9325&linkCode=pf4&tag={{ config('services.affiliate.amazon') }}&linkId=cd36abf3f3f5a0196847fdfc25efe942"><img src="/img/amazon-prime-video.png" style="height: 25px; width: auto; padding-right: 15px;"></a>

            </div>
            <div class="col-md-10 col-xs-8 text-left">

            <a target="_blank" href="https://www.amazon.com/gp/video/primesignup?ref_=assoc_tag_ph_1402131641212&_encoding=UTF8&camp=1789&creative=9325&linkCode=pf4&tag={{ config('services.affiliate.amazon') }}&linkId=cd36abf3f3f5a0196847fdfc25efe942">

            <span class="hidden-xs"> Watch Thousands of Movies &amp; TV Shows Anytime!</span>

            Start Your Free Amazon Prime Video Trial Now!</a>
                <img src="//ir-na.amazon-adsystem.com/e/ir?t=lessthanthrees-20&l=pf4&o=1" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important;" /></p>
            </div>

@endif
        </div>
    </div>
</div>
<!-- //ads -->
