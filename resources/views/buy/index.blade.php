@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">Cari Barang</h1>

    <div class="flex flex-wrap gap-2 mb-6">
        <a href="{{ route('buy.index') }}"
           class="px-4 py-1.5 rounded-full text-sm border {{ !isset($category) ? 'bg-blue-600 text-white' : 'bg-white' }}">
            Semua
        </a>
        @foreach ($categories as $cat)
            <a href="{{ route('buy.category', $cat->slug) }}"
               class="px-4 py-1.5 rounded-full text-sm border {{ isset($category) && $category->id === $cat->id ? 'bg-blue-600 text-white' : 'bg-white' }}">
                {{ $cat->name }}
            </a>
        @endforeach
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @forelse ($products as $product)
            <div class="border rounded-lg overflow-hidden bg-white">
                <a href="{{ route('buy.show', $product) }}">
                    <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://placehold.co/300x200?text=Barang' }}"
                         class="w-full h-36 object-cover">
                </a>
                <div class="p-3">
                    <div class="font-semibold text-sm truncate">{{ $product->name }}</div>
                    <div class="text-blue-600 font-bold text-sm">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                    <div class="text-xs text-gray-500">{{ $product->category->name }}</div>

                    <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-2">
                        @csrf
                        <button class="w-full bg-blue-600 text-white text-sm py-1.5 rounded hover:bg-blue-700">
                            + Keranjang
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <p class="col-span-4 text-gray-500">Belum ada barang di kategori ini.</p>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $products->links() }}
    </div>
</div>
@endsection