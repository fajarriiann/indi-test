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
            @foreach ($data as $val)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex items-center space-x-6">
                            <div class="w-80 h-52 overflow-hidden rounded-lg">
                                <img src="{{ asset('storage/'.$val->cover) }}" alt="" class="max-w-xs">
                            </div>
                            <div class="flex flex-col">
                                <a href="{{ route('article.detail', $val->slug) }}" class="font-bold text-2xl hover:underline transition-all duration-700">{{ $val->title }}</a>
                                <div>Kategori : {{ $val->category->name }}</div>
                                <div>Penulis : {{ $val->user->name }}</div>
                                <div>Tanggal : {{ date('d-m-Y', strtotime($val->created_at)) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>