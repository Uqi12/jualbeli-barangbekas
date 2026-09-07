@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white border rounded-lg overflow-hidden">
    <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://placehold.co/600x400?text=Barang' }}"
         class="w-full h-72 object-cover">

    <div class="p-6">
        <h1 class="text-2xl font-bold">{{ $product->name }}</h1>
        <div class="text-blue-600 font-bold text-xl mt-1">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
        <div class="text-sm text-gray-500 mt-1">Kategori: {{ $product->category->name }}</div>
        <div class="text-sm text-gray-500">Penjual: {{ $product->seller->name }}</div>

        <span class="inline-block mt-2 text-xs px-3 py-1 rounded-full bg-green-100 text-green-800">
            ✓ Barang Asli / Terverifikasi
        </span>

        <p class="mt-4 text-gray-700">{{ $product->description }}</p>

        <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-6">
            @csrf
            <button class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                Tambah ke Keranjang
            </button>
        </form>
    </div>
</div>
@endsection