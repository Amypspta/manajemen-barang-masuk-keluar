<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gudang Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">
    <!-- ✅ SIDEBAR -->
    <aside class="w-64 bg-white border-r">
        <div class="p-4 font-bold text-lg text-gray-700 border-b">
            Gudang Digital
        </div>
        <nav class="flex flex-col p-4 space-y-2 text-gray-600">
            <a href="{{ route('dashboard') }}" class="hover:text-black font-medium flex items-center">
                <i class="fas fa-home mr-2"></i> Dashboard
            </a>
            <a href="{{ route('transactions.index') }}" class="hover:text-black flex items-center">
                <i class="fas fa-box mr-2"></i> Manajemen Barang
            </a>
        </nav>
    </aside>

    <!-- ✅ MAIN CONTENT -->
    <div class="flex-1 overflow-auto">
        <header class="bg-white shadow-sm p-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold">Manajemen Barang</h2>
            <div class="flex items-center space-x-4">
                <span class="text-gray-600">Admin</span>
                <img src="..." alt="Admin" class="rounded-full w-8 h-8 bg-gray-300" />
            </div>
        </header>

        <main class="p-6">
            @yield('content')
        </main>
    </div>
</div>

         