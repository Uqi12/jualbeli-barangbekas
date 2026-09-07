@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">Keranjang Saya</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <div class="space-y-3">
        @forelse (optional($cart)->items ?? [] as $item)
            <div class="border rounded p-4 flex justify-between items-center">
                <div>
                    <div class="font-semibold">{{ $item->product->name }}</div>
                    <div class="text-sm text-gray-500">
                        Rp {{ number_format($item->product->price, 0, ',', '.') }} × {{ $item->quantity }}
                    </div>
                </div>
                <form action="{{ route('cart.remove', $item) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-600 text-sm">Hapus</button>
                </form>
            </div>
        @empty
            <p class="text-gray-500">Keranjangmu masih kosong.</p>
        @endforelse
    </div>
</div>
@endsection