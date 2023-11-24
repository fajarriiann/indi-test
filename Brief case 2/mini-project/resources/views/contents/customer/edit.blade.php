@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('customer.update', $data->id) }}" method="post">
                    @csrf
                    @method('put')
                        <div class="mb-6 flex items-center">
                            <label for="name" class="w-1/3 block mb-2 text-sm font-medium text-gray-900">Nama <span class="text-red-500">*</span></label>
                            <input type="text" id="name" name="name" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ $data->name }}" required>
                        </div>
                        <div class="mb-6 flex items-center">
                            <label for="domisili" class="w-1/3 block mb-2 text-sm font-medium text-gray-900">Domisili <span class="text-red-500">*</span></label>
                            <input type="text" id="domisili" name="domisili" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ $data->domisili }}" required>
                        </div>
                        <div class="mb-6 flex items-center">
                            <label for="gender" class="w-1/3 block mb-2 text-sm font-medium text-gray-900">Jenis Kelamin <span class="text-red-500">*</span></label>
                            <select name="gender" id="gender" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                <option value="PRIA" {{ $data->gender == 'PRIA' ? 'selected' : '' }}>PRIA</option>
                                <option value="WANITA" {{ $data->gender == 'WANITA' ? 'selected' : '' }}>WANITA</option>
                            </select>
                        </div>
                        <div class="flex justify-end items-center space-x-2">
                            @if (session('status') === 'customer-updated')
                                <p class="text-sm text-gray-600">Berhasil</p>
                            @endif
                            <a href="{{ route('customer.index') }}" class="px-4 py-2 bg-red-600 rounded-md font-semibold text-xs text-white uppercase hover:bg-red-500">Batal</a>
                            <button type="submit" class="px-4 py-2 bg-green-600 rounded-md font-semibold text-xs text-white uppercase hover:bg-green-500">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection