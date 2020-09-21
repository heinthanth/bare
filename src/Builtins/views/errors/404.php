<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Oops! Not Found</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,700" rel="stylesheet">

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

        #notfound {
            position: relative;
            height: 100vh;
        }

        #notfound .notfound {
            position: absolute;
            left: 50%;
            top: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }

        .notfound {
            max-width: 560px;
            width: 100%;
            padding-left: 160px;
            line-height: 1.1;
        }

        .notfound .notfound-404 {
            position: absolute;
            left: 0;
            top: 0;
            display: inline-block;
            width: 140px;
            height: 140px;
            background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAALwAAAC8CAYAAADCScSrAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyZpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMTM4IDc5LjE1OTgyNCwgMjAxNi8wOS8xNC0wMTowOTowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTcgKFdpbmRvd3MpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjBDQzkxRUNBNkYwODExRThBMEI0Qjk0Q0RDNkNBQkRBIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjBDQzkxRUNCNkYwODExRThBMEI0Qjk0Q0RDNkNBQkRBIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6MENDOTFFQzg2RjA4MTFFOEEwQjRCOTRDREM2Q0FCREEiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6MENDOTFFQzk2RjA4MTFFOEEwQjRCOTRDREM2Q0FCREEiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz5Q41UeAAAZLklEQVR42uxd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);
            background-size: cover;
        }

        .notfound .notfound-404:before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            -webkit-transform: scale(2.4);
            -ms-transform: scale(2.4);
            transform: scale(2.4);
            border-radius: 50%;
            background-color: #f2f5f8;
            z-index: -1;
        }

        .notfound h1 {
            font-family: 'Nunito', sans-serif;
            font-size: 65px;
            font-weight: 700;
            margin-top: 0px;
            margin-bottom: 10px;
            color: #151723;
            text-transform: uppercase;
        }

        .notfound h2 {
            font-family: 'Nunito', sans-serif;
            font-size: 21px;
            font-weight: 400;
            margin: 0;
            text-transform: uppercase;
            color: #151723;
        }

        .notfound p {
            font-family: 'Nunito', sans-serif;
            color: #999fa5;
            font-weight: 400;
        }

        .notfound a {
            font-family: 'Nunito', sans-serif;
            display: inline-block;
            font-weight: 700;
            border-radius: 40px;
            text-decoration: none;
            color: #388dbc;
        }

        @media only screen and (max-width: 767px) {
            .notfound .notfound-404 {
                width: 110px;
                height: 110px;
            }

            .notfound {
                padding-left: 15px;
                padding-right: 15px;
                padding-top: 110px;
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
    <div id="notfound">
        <div class="notfound">
            <div class="notfound-404"></div>
            <h1>404</h1>
            <h2>Oops! Page Not Be Found</h2>
            <p>Sorry but the page you are looking for does not exist, have been removed. name changed or is temporarily unavailable</p>
            <a href="/">Back to homepage</a>
        </div>
    </div>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>