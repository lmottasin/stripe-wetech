<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Small CSS to Hide elements at 1520px size -->
    <style>
        @media (max-width: 1920px) {
            .left-svg {
                display: none;
            }
        }

        /* small css for the mobile nav close */
        #nav-mobile-btn.close span:first-child {
            transform: rotate(45deg);
            top: 4px;
            position: relative;
            background: #a0aec0;
        }

        #nav-mobile-btn.close span:nth-child(2) {
            transform: rotate(-45deg);
            margin-top: 0px;
            background: #a0aec0;
        }
    </style>
</head>

<body class="antialiased overflow-x-hidden">
<div class="bg-gray-200 min-h-screen">
    @include('partials.authNav')

{{--    //validation error shown--}}
    @if ($errors->any())
        <div class="container mx-auto max-w-3xl mt-8">
            <div class="bg-red-500 text-white p-4 rounded-lg">
                <p class="font-bold">Please fix the following errors</p>
                <ul class="list-disc ml-8">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    @if (session('alert'))
        <div class="container mx-auto max-w-3xl mt-8">
            @php $alert_type = session('alert_type'); @endphp
            <div class="@if($alert_type == 'info'){{ 'bg-blue-400' }}@elseif($alert_type == 'success'){{ 'bg-green-400' }}@elseif($alert_type == 'error'){{ 'bg-red-400' }}@elseif($alert_type == 'warning'){{ 'bg-orange-400' }}@endif text-white p-4 rounded-lg" role="alert">
                <p class="font-bold">{{ ucfirst(session('alert_type')) }}</p>
                <p>{{ session('alert') }}</p>
            </div>
        </div>
    @endif
    @yield('content')
</div>

<script src="{{asset('js/custom.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>
@yield('javascript')

</body>
</html>
