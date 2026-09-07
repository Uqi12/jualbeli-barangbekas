@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">Jual Barang</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sell.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block font-medium mb-1">Kategori</label>
            <select name="category_id" class="w-full border rounded p-2" required>
                <option value="">-- Pilih kategori --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-medium mb-1">Nama Barang</label>
            <input type="text" name="name" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block font-medium mb-1">Deskripsi</label>
            <textarea name="description" rows="4" class="w-full border rounded p-2" required></textarea>
        </div>

        <div>
            <label class="block font-medium mb-1">Harga (Rp)</label>
            <input type="number" name="price" min="0" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block font-medium mb-1">Foto Barang</label>
            <input type="file" name="image" accept="image/*" class="w-full border rounded p-2">
        </div>

        <p class="text-sm text-gray-500">
            Catatan: barang yang kamu jual akan diperiksa dulu oleh admin sebelum tampil di halaman Beli.
        </p>

        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
            Pasang Barang
        </button>
    </form>
</div>
@endsection