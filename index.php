<?php

$iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
$iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
$Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");

?>
<!doctype html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./assets/images/radio.png">

    <title>Radio Stream</title>

    <!-- Bootstrap core CSS -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/font-awesome.css">
</head>

<div class="site-wrapper">
    <div class="site-wrapper-inner">
        <div class="cover-container">
            <header class="masthead clearfix" style="background-color: #f2f2f2">
                <div class="col-sm-12 col-lg-12">
                    <h3 style="text-align: center">Stream your radio channels</h3>
                </div>
            </header>

            <main role="main" class="inner">
                <div class="container">
                    <div class="col-lg-3 col-xs-6">
                        <div class="category_inner_div hover-custom">
                            <a href="#" class="d-block mb-4 h-100 radio-station" id="radio_mango">
                                <img class="img-fluid  img-thumbnail" src="https://pbs.twimg.com/profile_images/519781309640486912/-36KpVuY_400x400.jpeg">
                            </a>
                            <span>Radio Mango</span>
                        </div>
                    </div>

                    <div class="col-lg-3 col-xs-6 category_outer_div yb_lft_pad7">
                        <div class="category_inner_div hover-custom">
                            <a href="#" class="d-block mb-4 h-100 radio-station" id="club-fm">
                                <img class="img-fluid  img-thumbnail" src="http://www.rgbbroadcasting.com/wp-content/uploads/2016/04/image.jpg">
                            </a>
                            <span>Club FM</span>
                        </div>
                    </div>


                </div>
                <video id="video"></video>
                <audio id="club-fm-audio">
                    <source src="http://19013.live.streamtheworld.com/CLUBFMUAEAAC.aac" type='audio/mp4; codecs="mp4a.40.5"'>
                </audio>

            </main>
            <!--    Footer Container        -->
            <?php include('footer.php') ?>
            <!--     Footer Ends       -->
        </div>
    </div>
</div>
<!--================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="./assets/js/jquery-3.2.1.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
<script>

    $(document).ready(function(){
        var streamObj;
        document.addEventListener('touchmove', function (event) {
            if (event.scale !== 1) { event.preventDefault(); }
        }, false);

        $(".radio-station").click(function(){
            switch ($(this).attr('id')){
                case 'radio_mango':
                    playVideoUsingHls('http://iveradiomangoae-lh.akamaihd.net/i/RadioMango_1@25090/master.m3u8');
                    break;

                case 'club-fm':
                    playAudioElement($(this).attr('id'));
                    break;
            }
        });

        function playVideoUsingHls(playlistFileLink){
            checkCurrentPlaying();
            if(Hls.isSupported()) {
                streamObj = document.getElementById('video');
                var hls = new Hls();
                hls.loadSource(playlistFileLink);
                hls.attachMedia(streamObj);
                hls.on(Hls.Events.MANIFEST_PARSED,function() {
                    streamObj.play();
                });
            }
        }

        function playAudioElement(elm){
            checkCurrentPlaying();
            streamObj = $("#"+elm+'-audio')[0];
            streamObj.play();
        }

        function checkCurrentPlaying(){
            if(streamObj){
                streamObj.pause();
                streamObj= {};
            }
        }
    });

</script>
</body>
</html>
