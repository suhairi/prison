<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prison Kedah</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />

    <style>
        @page { 
            margin-top:20px;
            margin-bottom: 20px;
            margin-left: 10px;
            margin-right: 10px;
        }
    </style>


</head>
<body>
    @yield('content')
    <script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>
</html>