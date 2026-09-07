@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-2">Verifikasi Barang</h1>
    <p class="text-gray-500 mb-6">Periksa apakah barang yang dijual user asli atau palsu.</p>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <div class="space-y-4">
        @forelse ($products as $product)
            <div class="border rounded-lg p-4 bg-white flex gap-4">
                <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://placehold.co/150x100?text=Barang' }}"
                     class="w-32 h-24 object-cover rounded">

                <div class="flex-1">
                    <div class="font-semibold">{{ $product->name }}</div>
                    <div class="text-sm text-gray-500">
                        {{ $product->category->name }} · Rp {{ number_format($product->price, 0, ',', '.') }}
                        · Penjual: {{ $product->seller->name }}
                    </div>
                    <p class="text-sm text-gray-700 mt-1">{{ $product->description }}</p>

                    <div class="flex gap-2 mt-3">
                        <form action="{{ route('admin.products.verify', $product) }}" method="POST">
                            @csrf @method('PATCH')
                            <button class="bg-green-600 text-white text-sm px-4 py-1.5 rounded hover:bg-green-700">
                                ✓ Tandai Asli
                            </button>
                        </form>

                        <form action="{{ route('admin.products.mark-fake', $product) }}" method="POST" class="flex gap-2">
                            @csrf @method('PATCH')
                            <input type="text" name="admin_note" placeholder="Alasan (opsional)"
                                   class="border rounded text-sm px-2 py-1">
                            <button class="bg-red-600 text-white text-sm px-4 py-1.5 rounded hover:bg-red-700">
                                ✕ Tandai Palsu
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-500">Tidak ada barang yang menunggu verifikasi. 🎉</p>
        @endforelse
    </div>
</div>
@endsection