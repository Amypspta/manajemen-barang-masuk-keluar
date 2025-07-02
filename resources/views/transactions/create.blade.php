<!-- resources/views/transactions/create.blade.php -->

@extends('layouts.app') <!-- Pastikan kamu punya layouts/app.blade.php -->

@section('content')
<div class="container">
     <h1 class="text-xl font-bold mb-4">Form Barang Masuk/Keluar</h1>

    <!-- Isi form transaksi seperti sebelumnya -->
    <h2>Catat Transaksi Barang</h2>

    @if(session('success'))
        <div style="color: green">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div style="color: red">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('transactions.store') }}">
        @csrf

        <div>
            <label>Produk</label>
            <select name="product_id" required>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">
                        {{ $product->name }} (Stok: {{ $product->stock }})
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Jenis Transaksi</label>
            <select name="type" required>
                <option value="in">Barang Masuk</option>
                <option value="out">Barang Keluar</option>
            </select>
        </div>

        <div>
            <label>Jumlah</label>
            <input type="number" name="quantity" min="1" required>
        </div>

        <button type="submit">Simpan Transaksi</button>
    </form>
</div>
@endsection
