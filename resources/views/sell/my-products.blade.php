@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Barang Saya</h1>
        <a href="{{ route('sell.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">+ Tambah Barang</a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <div class="space-y-3">
        @forelse ($products as $product)
            <div class="border rounded p-4 flex justify-between items-center">
                <div>
                    <div class="font-semibold">{{ $product->name }}</div>
                    <div class="text-sm text-gray-500">{{ $product->category->name ?? '-' }} · Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                    @if ($product->status === 'fake' && $product->admin_note)
                        <div class="text-sm text-red-600 mt-1">Catatan admin: {{ $product->admin_note }}</div>
                    @endif
                </div>

                @php
                    $badge = match($product->status) {
                        'pending' => 'bg-yellow-100 text-yellow-800',
                        'verified' => 'bg-green-100 text-green-800',
                        'fake' => 'bg-red-100 text-red-800',
                    };
                    $label = match($product->status) {
                        'pending' => 'Menunggu Verifikasi',
                        'verified' => 'Asli / Terverifikasi',
                        'fake' => 'Ditandai Palsu',
                    };
                @endphp
                <span class="text-xs px-3 py-1 rounded-full {{ $badge }}">{{ $label }}</span>
            </div>
        @empty
            <p class="text-gray-500">Kamu belum menjual barang apa pun.</p>
        @endforelse
    </div>
</div>
@endsection