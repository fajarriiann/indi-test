@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('item.store') }}" method="post">
                    @csrf
                    @method('post')
                        <div class="mb-6 flex items-center">
                            <label for="name" class="w-1/3 block mb-2 text-sm font-medium text-gray-900">Nama <span class="text-red-500">*</span></label>
                            <input type="text" id="name" name="name" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        </div>
                        <div class="mb-6 flex items-center">
                            <label for="category" class="w-1/3 block mb-2 text-sm font-medium text-gray-900">Kategori <span class="text-red-500">*</span></label>
                            <input type="text" id="category" name="category" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        </div>
                        <div class="mb-6 flex items-center">
                            <label for="price" class="w-1/3 block mb-2 text-sm font-medium text-gray-900">Harga <span class="text-red-500">*</span></label>
                            <input type="number" id="price" name="price" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        </div>
                        <div class="flex justify-end items-center space-x-2">
                            @if (session('status') === 'item-created')
                                <p class="text-sm text-gray-600">Berhasil</p>
                            @endif
                            <a href="{{ route('item.index') }}" class="px-4 py-2 bg-red-600 rounded-md font-semibold text-xs text-white uppercase hover:bg-red-500">Batal</a>
                            <button type="submit" class="px-4 py-2 bg-green-600 rounded-md font-semibold text-xs text-white uppercase hover:bg-green-500">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection