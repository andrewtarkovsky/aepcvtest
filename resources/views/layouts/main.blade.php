<html>
<head>
    <link href="{{ asset('css/app.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/bootstrap.min.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/main.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/nav.css') }}" media="all" rel="stylesheet" type="text/css" />
    <title>AEPCVTEST - @yield('title')</title>
</head>
<body>
<div class="container aepcvtest-container" id="app">
    @include('nav')
    @yield('content')
</div>

<script>
    window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
    ]); ?>
</script>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

</body>
</html>