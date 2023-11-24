@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('customer.create') }}" class="mt-5 px-4 py-2 bg-green-600 rounded-md font-semibold text-xs text-white uppercase hover:bg-green-500">Tambah Pelanggan</a>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">No</th>
                                    <th scope="col" class="px-6 py-3">Nama</th>
                                    <th scope="col" class="px-6 py-3">Domisili</th>
                                    <th scope="col" class="px-6 py-3">Jenis Kelamin</th>
                                    <th scope="col" class="px-6 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @if (count($data) == 0)
                                    <tr>
                                        <td colspan="5" class="italic text-center px-6 py-4">Data Kosong</td>
                                    </tr>
                                @else
                                    @foreach ($data as $val)
                                        <tr class="odd:bg-white even:bg-gray-50 border-b">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $no++ }}.</th>
                                            <td class="px-6 py-4">{{ $val->name }}</td>
                                            <td class="px-6 py-4">{{ $val->domisili }}</td>
                                            <td class="px-6 py-4">{{ $val->gender }}</td>
                                            <td class="px-6 py-4">
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('customer.edit', $val->id) }}" class="px-4 py-2 bg-yellow-600 rounded-md font-semibold text-xs text-white uppercase hover:bg-yellow-500">Edit</a>
                                                    <form action="{{ route('customer.destroy', $val->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                        <button type="submit" class="px-4 py-2 bg-red-600 rounded-md font-semibold text-xs text-white uppercase hover:bg-red-500">Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection