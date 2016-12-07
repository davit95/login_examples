<!DOCTYPE html>
<html>
<head>
    <title>Canvas page flipper</title>
    <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>
<ul id="lstImages" class="imagesSource">
    <li><img alt="BMW" src="assets/images/bmw-z8.jpg" /></li>
    <li><img alt="BMW" src="assets/images/celica.jpg" /></li>
    {{--<li><img alt="BMW" src="images/koenigsegg.jpg" /></li>--}}
    {{--<li><img alt="BMW" src="images/manila 2.jpg" /></li>--}}
    {{--<li><img alt="BMW" src="images/manila.jpg" /></li>--}}
    {{--<li><img alt="BMW" src="images/koenigsegg.jpg" /></li>--}}
    {{--<li><img alt="BMW" src="images/bmw-z8.jpg" /></li>--}}
    {{--<li><img alt="BMW" src="images/manila 2.jpg" /></li>--}}
</ul>

<script type="text/javascript" src="assets/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="assets/js/jquery-1.4.1-vsdoc.js"></script>
<script type="text/javascript" src="assets/js/jquery.pageFlipper.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var isIPad = navigator.userAgent.indexOf('iPad') >= 0;

        $('#lstImages').pageFlipper({
            fps: isIPad ? 10 : 20,
            easing: isIPad ? 0.3 : 0.2,
            backgroundColor: '#aaaaaa'
        });

        $('.canvasHolder').css('left', (isIPad ? 0 : 130) + 'px');
        $('#mouse').css({
            width: (isIPad ? 40 : 20) + 'px',
            height: (isIPad ? 40 : 20) + 'px',
            '-moz-border-radius': (isIPad ? 20 : 10) + 'px',
            '-webkit-border-radius': (isIPad ? 20 : 10) + 'px'
        });
    });
</script>
</body>
</html>
