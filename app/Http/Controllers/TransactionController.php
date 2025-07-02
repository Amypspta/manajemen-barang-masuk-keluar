<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
{
    return view('transactions.index', [
        'products' => \App\Models\Product::all(),
        'transactions' => \App\Models\Transaction::with('product', 'user')->latest()->get()
]);

}

public function store(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'type' => 'required|in:in,out',
        'quantity' => 'required|integer|min:1',
    ]);

    $product = Product::findOrFail($request->product_id);

    if ($request->type === 'out' && $product->stock < $request->quantity) {
        return back()->with('error', 'Stok tidak mencukupi!');
    }

    $product->stock += ($request->type === 'in') ? $request->quantity : -$request->quantity;
    $product->save();

    Transaction::create([
        'user_id' => auth()->id(),
        'product_id' => $request->product_id,
        'type' => $request->type,
        'quantity' => $request->quantity,
    ]);

    return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil disimpan.');
}

}
