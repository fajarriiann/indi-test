<nav class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-start h-16">
            <div class="flex">
                <div class=" space-x-8 -my-px ms-10 flex">
                    <a href="{{ route('sale.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-500 hover:text-gray-700 {{ request()->routeIs('sale.index') ? 'text-gray-900' : '' }}">
                        Penjualan
                    </a>
                    <a href="{{ route('item.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-500 hover:text-gray-700 {{ request()->routeIs('item.index') ? 'text-gray-900' : '' }}">
                        Barang
                    </a>
                    <a href="{{ route('customer.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-500 hover:text-gray-700 {{ request()->routeIs('customer.index') ? 'text-gray-900' : '' }}">
                        Pelanggan
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>