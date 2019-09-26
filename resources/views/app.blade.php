<html>
<head>
    <title>App Name - @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('libs/bootstrap/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('libs/datatables/css/jquery.dataTables.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="{{asset('libs/bootstrap/js/bootstrap.js')}}"></script>
    <script src="{{asset('libs/jquery/jquery.js')}}"></script>
    <script src="{{asset('libs/datatables/js/jquery.dataTables.js')}}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

</head>
<body>

<div class="container">
    @if(\Auth::check())
        <div class="text-right mt-3 mb-5 " >
            <a class="btn btn-success inline_block mr-3" href="{{ route('score') }}">Միավորների հաշիվ        </a>
            <a class="btn btn-success inline_block mr-3" href="{{ route('game') }}"> Խաղալ </a>
            <p class="inline_block"> {{ \Auth::user()->name .' '. \Auth::user()->surname }} </p>
            <a class="text-white inline_block" href="{{ url('/logout') }}">Ելք</a>
        </div>
    @endif
    @yield('content')
</div>
</body>
<footer>

</footer>
</html>