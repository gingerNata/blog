<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="A general guide on the use of meta tags in html pages"/>
    <meta name="keywords" content="web,design,html,css,html5,development">
    {{--<meta name="twitter:card" content="summary" />--}}
    {{--<meta name="twitter:site" content="@nytimesbits" />--}}
    {{--<meta name="twitter:creator" content="@nickbilton" />--}}
    <meta property="og:url" content="http://bits.blogs.nytimes.com/2011/12/08/a-twitter-for-my-sister/"/>
    <meta property="og:title" content="A Twitter for My Sister"/>
    <meta property="og:type" content="Article"/>
    <meta property="og:description" content="In the keep the rocket ship from stalling."/>
    <meta property="og:image"
          content="http://graphics8.nytimes.com/images/2011/12/08/technology/bits-newtwitter/bits-newtwitter-tmagArticle.jpg"/>
    <meta property="fb:admins" content="1256049241">
    <meta property="fb:app_id" content="121695974580830">

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>{{ config('app.name', 'Джерело життя') }}</title>

    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="/css/header.css" rel="stylesheet">
    <link href="/css/post.css" rel="stylesheet">
    <link href="/css/index.css" rel="stylesheet">


    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <script src="/js/like.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    {{--<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=sd8ro0e1vm3hkpnxdrds70oyxovd6yf0bhdac010cm254zz6"></script>--}}
    <script src="/src/js/vendor/tinymce/js/tinymce/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            language: 'ru',
            skin: 'custom',
//            content_css : '/mycontent.css',
            menubar: false,
            toolbar: 'undo redo styleselect  forecolor backcolor fontselect fontsizeselect bold italic alignleft aligncenter alignright bullist ' +
            'advlist numlist code link unlink image hr outdent indent anchor table tabledelete',
            plugins: 'advlist code hr image imagetools anchor link paste table textcolor colorpicker media textcolor lists',

            images_upload_url: '/postAcceptor.php'
        });
    </script>

</head>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>


@include('layouts.headerNavigation')
@yield('slider')

<div class="container-wrapper">
    <div class="container main-content">
        @yield('content')
    </div>
</div>

<div class="container-wrapper">
    <div class="container bottom-content">
        @yield('bottom-content')
    </div>
</div>



@include('layouts.footer')

</body>
</html>
