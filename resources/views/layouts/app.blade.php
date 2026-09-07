<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>OLX Clone</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

    <nav class="bg-white border-b px-6 py-3 flex justify-between items-center">
        <a href="{{ route('home') }}" class="text-xl font-bold text-blue-600">OLX Clone</a>

        <div class="flex items-center gap-4 text-sm">
            @auth
                <a href="{{ route('choice') }}" class="hover:text-blue-600">Beli/Jual</a>
                <a href="{{ route('buy.index') }}" class="hover:text-blue-600">Beli</a>
                <a href="{{ route('sell.my-products') }}" class="hover:text-blue-600">Barang Saya</a>
                <a href="{{ route('cart.index') }}" class="hover:text-blue-600">Keranjang</a>

                @if (auth()->user()->is_admin)
                    <a href="{{ route('admin.products.index') }}" class="text-red-600 hover:underline">Admin</a>
                @endif

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="hover:text-blue-600">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="hover:text-blue-600">Login</a>
                <a href="{{ route('register') }}" class="hover:text-blue-600">Daftar</a>
            @endauth
        </div>
    </nav>

    <main class="px-4 pb-16">
        @yield('content')
    </main>

</body>
</html>