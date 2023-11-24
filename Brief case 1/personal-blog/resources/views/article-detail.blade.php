<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 pt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex justify-between">
                <a href="{{ url('/') }}" class="font-bold text-xl">Daftar Artikel</a>
                <a href="{{ route('login') }}">Login</a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex flex-col items-center">
                        <div class="font-extrabold text-5xl text-center">{{ $data->title }}</div>
                        <img src="{{ asset('storage/'.$data->cover) }}" alt="" class="rounded-lg my-10">
                        <div>{!! $data->content !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>