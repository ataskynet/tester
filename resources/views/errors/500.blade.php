<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | 404 Error</title>

    <link href="{{ asset('inspina/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('inspina/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <link href="{{ asset('inspina/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('inspina/css/style.css') }}" rel="stylesheet">

</head>

<body class="gray-bg">


    <div class="middle-box text-center animated fadeInDown">
        <h1>500</h1>
        <h3 class="font-bold">Internal Server Error</h3>

        <div class="error-desc">
            The server encountered something unexpected that didn't allow it to complete the request. We apologize.<br/>
            You can go back to main page: <br/><a href="{{ url('/') }}" class="btn btn-primary m-t">Back Home</a>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('inspina/js/jquery-2.1.1.js') }}"></script>
    <script src="{{ asset('inspina/js/bootstrap.min.js') }}"></script>

</body>

</html>
