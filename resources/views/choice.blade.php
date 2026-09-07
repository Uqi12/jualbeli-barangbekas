@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-20 text-center">
    <h1 class="text-3xl font-bold mb-8">Halo, {{ auth()->user()->name }}! Apa yang ingin kamu lakukan?</h1>

    <div class="flex justify-center gap-6">
        <a href="{{ route('buy.index') }}"
           class="w-56 py-10 bg-white border-2 border-gray-200 rounded-xl shadow hover:border-blue-500 transition">
            <div class="text-4xl mb-2">🛒</div>
            <div class="text-xl font-semibold">Beli</div>
            <p class="text-sm text-gray-500 mt-1">Cari barang yang kamu butuhkan</p>
        </a>

        <a href="{{ route('sell.create') }}"
           class="w-56 py-10 bg-white border-2 border-gray-200 rounded-xl shadow hover:border-green-500 transition">
            <div class="text-4xl mb-2">🏷️</div>
            <div class="text-xl font-semibold">Jual</div>
            <p class="text-sm text-gray-500 mt-1">Pasang barang yang kamu jual</p>
        </a>
    </div>
</div>
@endsection