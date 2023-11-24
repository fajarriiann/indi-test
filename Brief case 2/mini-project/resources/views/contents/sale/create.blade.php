@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('sale.array') }}" method="post">
                    @csrf
                    @method('post')
                        <div class="mb-6 flex items-center">
                            <label for="item" class="w-1/3 block mb-2 text-sm font-medium text-gray-900">Barang <span class="text-red-500">*</span></label>
                            <select name="item" id="item" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                @foreach ($item as $key => $val)
                                    <option value="{{ $key }}">{{ $val }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-6 flex items-center">
                            <label for="qty" class="w-1/3 block mb-2 text-sm font-medium text-gray-900">Qty <span class="text-red-500">*</span></label>
                            <input type="number" id="qty" name="qty" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        </div>
                        <div class="flex justify-end items-center space-x-2">
                            <button type="submit" class="px-4 py-2 bg-green-600 rounded-md font-semibold text-xs text-white uppercase hover:bg-green-500">Tmabah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="font-bold text-lg">Data Transaksi</h1>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">No</th>
                                    <th scope="col" class="px-6 py-3">Nama</th>
                                    <th scope="col" class="px-6 py-3">Harga</th>
                                    <th scope="col" class="px-6 py-3">Qty</th>
                                    <th scope="col" class="px-6 py-3">Total</th>
                                    <th scope="col" class="px-6 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                    $total = 0;
                                @endphp
                                @if (empty($session))
                                    <tr>
                                        <td colspan="6" class="italic text-center px-6 py-4">Data Kosong</td>
                                    </tr>
                                @else
                                    @foreach ($session as $key => $val)
                                        <tr class="odd:bg-white even:bg-gray-50 border-b">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $no++ }}.</th>
                                            <td class="px-6 py-4">{{ $val['name'] }}</td>
                                            <td class="px-6 py-4">{{ $val['price'] }}</td>
                                            <td class="px-6 py-4">{{ $val['qty'] }}</td>
                                            <td class="px-6 py-4">{{ $val['total'] }}</td>
                                            <td class="px-6 py-4">
                                                <a href="{{ route('sale.array.delete', $key) }}" class="px-4 py-2 bg-red-600 rounded-md font-semibold text-xs text-white uppercase hover:bg-red-500">Hapus</a>
                                            </td>
                                        </tr>
                                        @php
                                            $total += $val['total'];
                                        @endphp
                                    @endforeach
                                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                                        <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap" colspan="4">Total</th>
                                        <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $total }}</th>
                                        <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"></th>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <form action="{{ route('sale.store') }}" method="post" class="mt-7">
                    @csrf
                    @method('post')
                        <input type="number" name="total" value="{{ $total }}" hidden>
                        <div class="mb-6 flex items-center">
                            <label for="tgl" class="w-1/3 block mb-2 text-sm font-medium text-gray-900">Tanggal <span class="text-red-500">*</span></label>
                            <input type="date" id="tgl" name="tgl" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="mb-6 flex items-center">
                            <label for="customer" class="w-1/3 block mb-2 text-sm font-medium text-gray-900">Pelanggan <span class="text-red-500">*</span></label>
                            <select name="customer" id="customer" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                @foreach ($customer as $key => $val)
                                    <option value="{{ $key }}">{{ $val }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex justify-end items-center space-x-2">
                            @if (session('status') === 'sale-created')
                                <p class="text-sm text-gray-600">Berhasil</p>
                            @endif
                            @if (session('status') === 'sale-error')
                                <p class="text-sm text-red-600">Tidak ada data</p>
                            @endif
                            <a href="{{ route('sale.index') }}" class="px-4 py-2 bg-red-600 rounded-md font-semibold text-xs text-white uppercase hover:bg-red-500">Batal</a>
                            <button type="submit" class="px-4 py-2 bg-green-600 rounded-md font-semibold text-xs text-white uppercase hover:bg-green-500">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection