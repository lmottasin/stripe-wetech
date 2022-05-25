<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Small CSS to Hide elements at 1520px size -->
    <style>
        @media(max-width:1920px){
            .left-svg{
                display:none;
            }
        }
        /* small css for the mobile nav close */
        #nav-mobile-btn.close span:first-child{
            transform: rotate(45deg);
            top: 4px;
            position: relative;
            background:#a0aec0;
        }
        #nav-mobile-btn.close span:nth-child(2){
            transform: rotate(-45deg);
            margin-top: 0px;
            background:#a0aec0;
        }
    </style>
</head>

<body class="antialiased overflow-x-hidden">

@include('partials.nav')

@yield('content')

<script src="{{asset('js/custom.js')}}"></script>

</body>
</html>
