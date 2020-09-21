<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Oops! Wrong Method</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,400,700" rel="stylesheet">

    <!-- Custom stlylesheet -->
    <style>
        * {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        body {
            padding: 0;
            margin: 0;
        }

        #methodnotallowed {
            position: relative;
            height: 100vh;
        }

        #methodnotallowed .methodnotallowed {
            position: absolute;
            left: 50%;
            top: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }

        .methodnotallowed {
            max-width: 520px;
            width: 100%;
            line-height: 1.4;
            text-align: center;
        }

        .methodnotallowed .methodnotallowed-405 {
            position: relative;
            height: 200px;
            margin: 0px auto 20px;
            z-index: -1;
        }

        .methodnotallowed .methodnotallowed-405 h1 {
            font-family: 'Montserrat', sans-serif;
            font-size: 236px;
            font-weight: 200;
            margin: 0px;
            color: #211b19;
            text-transform: uppercase;
            position: absolute;
            left: 50%;
            top: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }

        .methodnotallowed .methodnotallowed-405 h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 28px;
            font-weight: 400;
            text-transform: uppercase;
            color: #211b19;
            background: #fff;
            padding: 10px 5px;
            margin: auto;
            display: inline-block;
            position: absolute;
            bottom: 0px;
            left: 0;
            right: 0;
        }

        .methodnotallowed a {
            font-family: 'Montserrat', sans-serif;
            display: inline-block;
            font-weight: 700;
            text-decoration: none;
            color: #fff;
            text-transform: uppercase;
            padding: 13px 23px;
            background: #ff6300;
            font-size: 18px;
            -webkit-transition: 0.2s all;
            transition: 0.2s all;
        }

        .methodnotallowed a:hover {
            color: #ff6300;
            background: #211b19;
        }

        @media only screen and (max-width: 767px) {
            .methodnotallowed .methodnotallowed-405 h1 {
                font-size: 148px;
            }
        }

        @media only screen and (max-width: 480px) {
            .methodnotallowed .methodnotallowed-405 {
                height: 148px;
                margin: 0px auto 10px;
            }

            .methodnotallowed .methodnotallowed-405 h1 {
                font-size: 86px;
            }

            .methodnotallowed .methodnotallowed-405 h2 {
                font-size: 16px;
            }
        }
    </style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>

<body>

    <div id="methodnotallowed">
        <div class="methodnotallowed">
            <div class="methodnotallowed-405">
                <h1>Oops!</h1>
                <h2>405 - Method Not Allowed</h2>
            </div>
        </div>
    </div>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>