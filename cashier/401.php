<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Welcome to WEB-POS</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/bootstrap/bootstrap.css" />
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body class="position-relative">
    <a class="position-absolute top-0 start-0 btn btn-lg btn-outline-secondary fs-5 ms-4 mt-4" href="../index.php" style="z-index: 1;">Go Back</a>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
             <strong style="font-family: 'Raleway', sans-serif;"><span style="color: red;">Oops</span>❗| 401</strong><br>
             Invalid Credentials.<br>
             <button type="submit" class="btn btn-primary btn-lg" onclick="window.location.href='index.php'">Try again</button>
            </div>
        </div>
    </div>
</body>
</html>