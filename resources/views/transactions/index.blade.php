@extends('layouts.app')

@section('content')
@if (session('success'))
    <div class="mb-4 p-4 bg-green-100 text-green-800 border border-green-300 rounded">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="mb-4 p-4 bg-red-100 text-red-800 border border-red-300 rounded">
        {{ session('error') }}
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

    <!-- FORM BARANG MASUK -->
    <div class="bg-white p-6 rounded shadow border-l-4 border-green-500">
        <h2 class="text-green-600 text-lg font-semibold mb-4">Barang Masuk</h2>
        <form method="POST" action="{{ route('transactions.store') }}">
            @csrf
            <input type="hidden" name="type" value="in">

            <div class="mb-4">
                <label class="block text-sm font-medium">Produk</label>
              <select name="product_id" class="w-full border border-gray-300 rounded p-2" required>
    <option value="">-- Pilih Produk Digital --</option>
    @foreach ($products as $product)
        <option value="{{ $product->id }}">
            {{ $product->name }} (Stok: {{ $product->stock }})
        </option>
    @endforeach
</select>



            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Jumlah</label>
                <input type="number" name="quantity" min="1" class="w-full border border-gray-300 rounded p-2" required>
            </div>

            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                Simpan Barang Masuk
            </button>
        </form>
    </div>

    <!-- FORM BARANG KELUAR -->
    <div class="bg-white p-6 rounded shadow border-l-4 border-red-500">
        <h2 class="text-red-600 text-lg font-semibold mb-4">Barang Keluar</h2>
        <form method="POST" action="{{ route('transactions.store') }}">
            @csrf
            <input type="hidden" name="type" value="out">

            <div class="mb-4">
                <label class="block text-sm font-medium">Produk</label>
                <select name="product_id" class="w-full border border-gray-300 rounded p-2" required>
    <option value="">-- Pilih Produk Digital --</option>
    @foreach ($products as $product)
        <option value="{{ $product->id }}">
            {{ $product->name }} (Stok: {{ $product->stock }})
        </option>
    @endforeach
</select>


            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Jumlah</label>
                <input type="number" name="quantity" min="1" class="w-full border border-gray-300 rounded p-2" required>
            </div>

            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                Simpan Barang Keluar
            </button>
        </form>
    </div>
</div>

<!-- TABEL RIWAYAT TRANSAKSI -->
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-lg font-semibold mb-4">Riwayat Transaksi</h2>

    <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
        <thead class="bg-gray-100 text-xs uppercase text-gray-600">
            <tr>
                <th class="px-4 py-2 text-left">Tanggal</th>
                <th class="px-4 py-2 text-left">Produk</th>
                <th class="px-4 py-2 text-left">Jenis</th>
                <th class="px-4 py-2 text-left">Jumlah</th>
                <th class="px-4 py-2 text-left">User</th>
            </tr>
        </thead>
        <tbody class="bg-white text-sm text-gray-700 divide-y divide-gray-100">
            @forelse($transactions as $trx)
                <tr>
                    <td class="px-4 py-2">{{ $trx->created_at->format('d-m-Y H:i') }}</td>
                    <td class="px-4 py-2">{{ $trx->product->name }}</td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-1 rounded-full text-xs {{ $trx->type == 'in' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $trx->type == 'in' ? 'Masuk' : 'Keluar' }}
                        </span>
                    </td>
                    <td class="px-4 py-2">{{ $trx->quantity }}</td>
                    <td class="px-4 py-2">{{ $trx->user->name }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-4 py-4 text-center text-gray-400">Belum ada transaksi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
