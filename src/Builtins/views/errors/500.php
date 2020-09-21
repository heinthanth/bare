<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ooops!</title>
    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
            font-size: 16px;
            font-family: Helvetica, Arial, sans-serif, system-ui;
        }

        body {
            display: -webkit-box;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            flex-direction: column;
            -webkit-box-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            align-items: center;
            overflow: hidden;
            margin: 0;
            color: #e6e6e6;
            background: #0b5d59 radial-gradient(circle at center, #66003b 0%, #65003b 8.1%, #62013a 15.5%, #5e0238 22.5%, #580435 29%, #510632 35.3%, #4a082f 41.2%, #420a2b 47.1%, #3b0d27 52.9%, #330f24 58.8%, #2b1120 64.7%, #25131d 71%, #1f151b 77.5%, #1b1619 84.5%, #181717 91.9%, #171717 100%);
        }

        h1 {
            --distance: .01em;
            --dist-factor: 1;
            position: relative;
            display: block;
            margin: 0;
            font-size: 15vmax;
            font-weight: normal;
            font-family: monospace;
            line-height: 1;
            color: #db73b0;
            -webkit-filter: saturate(150%);
            filter: saturate(150%);
        }

        h1>[data-overlay] {
            position: relative;
        }

        h1>[data-overlay]::after {
            --dist-factor: 32;
            content: attr(data-overlay);
            position: absolute;
            left: 0;
            top: 0;
            display: -webkit-box;
            display: flex;
            -webkit-box-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            align-items: center;
            width: 100%;
            height: 100%;
            color: #ffd200;
            font-size: .125em;
        }

        h1,
        h1::after,
        h1 [data-overlay]::after {
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            -webkit-animation: animText 3s linear infinite;
            animation: animText 3s linear infinite;
        }

        h1::after {
            --dist-factor: 2;
            content: attr(data-txt);
            position: absolute;
            left: 0;
            top: 0;
            color: #73c5c1;
            mix-blend-mode: screen;
        }

        h1::after,
        h1 [data-overlay]:first-child::after {
            animation-direction: reverse;
        }

        p {
            position: relative;
            color: #e6e6e6;
            text-align: center;
        }

        @-webkit-keyframes animText {
            0% {
                -webkit-transform: rotate(0deg) translate(calc(var(--distance) * -1 * var(--dist-factor)), calc(var(--distance) * -1 * var(--dist-factor))) rotate(0deg);
                transform: rotate(0deg) translate(calc(var(--distance) * -1 * var(--dist-factor)), calc(var(--distance) * -1 * var(--dist-factor))) rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg) translate(calc(var(--distance) * -1 * var(--dist-factor)), calc(var(--distance) * -1 * var(--dist-factor))) rotate(-360deg);
                transform: rotate(360deg) translate(calc(var(--distance) * -1 * var(--dist-factor)), calc(var(--distance) * -1 * var(--dist-factor))) rotate(-360deg);
            }
        }

        @keyframes animText {
            0% {
                -webkit-transform: rotate(0deg) translate(calc(var(--distance) * -1 * var(--dist-factor)), calc(var(--distance) * -1 * var(--dist-factor))) rotate(0deg);
                transform: rotate(0deg) translate(calc(var(--distance) * -1 * var(--dist-factor)), calc(var(--distance) * -1 * var(--dist-factor))) rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg) translate(calc(var(--distance) * -1 * var(--dist-factor)), calc(var(--distance) * -1 * var(--dist-factor))) rotate(-360deg);
                transform: rotate(360deg) translate(calc(var(--distance) * -1 * var(--dist-factor)), calc(var(--distance) * -1 * var(--dist-factor))) rotate(-360deg);
            }
        }

        .titanic {
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            height: .1725em;
            font-size: 50vmax;
            -webkit-transform-origin: 33.3% 100%;
            transform-origin: 33.3% 100%;
            -webkit-transform: rotate(30deg);
            transform: rotate(30deg);
        }

        .titanic::before,
        .titanic::after {
            content: '';
            margin: 0 auto;
        }

        .titanic::before {
            position: absolute;
            left: .125em;
            right: .5em;
            bottom: 100%;
            width: .1em;
            height: .25em;
            border-radius: .0125em;
            background: #161616;
            box-shadow: 0.25em 0 0 #161616, 0.5em 0 0 #161616;
        }

        .titanic::after {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            width: 1em;
            height: .25em;
            background: -webkit-gradient(linear, left top, left bottom, color-stop(19.5%, #7e7e7e), color-stop(20.5%, #730b0b), color-stop(79.5%, #730b0b), color-stop(80.5%, #161616));
            background: linear-gradient(to bottom, #7e7e7e 19.5%, #730b0b 20.5%, #730b0b 79.5%, #161616 80.5%);
            -webkit-clip-path: polygon(0 0, 100% 0, calc(100% - .025em) 0.05em, calc(100% - .1em) 100%, 0.1em 100%, 0.025em 0.05em);
            clip-path: polygon(0 0, 100% 0, calc(100% - .025em) 0.05em, calc(100% - .1em) 100%, 0.1em 100%, 0.025em 0.05em);
        }
    </style>
</head>

<body>
    <div class="titanic"></div>

    <h1 data-txt="5⬡⬡" aria-label="Internal Server Error">5<span data-overlay="🤦‍♀️">⬡</span><span data-overlay="🤦‍♂️">⬡</span></h1>
    <p>It's broken, but it's not your fault.</p>

</body>

</html>