<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TransaksiLogistik;
use App\Models\LogistikTambang;
use Illuminate\Http\Request;

class TransaksiLogistikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil riwayat transaksi terbaru beserta data barangnya (Relasi)
        $transaksi = TransaksiLogistik::with('logistik')->latest()->get();
        return view('transaksi.index', compact('transaksi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Membawa data logistik untuk ditampilkan di pilihan (dropdown) form
        $barang = LogistikTambang::all();
        return view('transaksi.create', compact('barang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'logistik_tambang_id' => 'required|exists:logistik_tambangs,id',
            'jenis_transaksi'     => 'required|in:Masuk,Keluar',
            'kuantitas'           => 'required|integer|min:1',
            'tanggal_transaksi'   => 'required|date',
            'keterangan'          => 'nullable|string'
        ]);

        // 2. Tarik data barang yang dipilih
        $barang = LogistikTambang::findOrFail($request->logistik_tambang_id);

        // 3. Logika Mutasi Stok Otomatis
        if ($request->jenis_transaksi == 'Keluar') {
            // Cegah pengeluaran jika stok tidak cukup
            if ($barang->stok_aktual < $request->kuantitas) {
                return back()->with('error', 'Gagal! Stok aktual tidak mencukupi untuk dikeluarkan.');
            }
            // Kurangi stok
            $barang->stok_aktual -= $request->kuantitas;
        } else {
            // Tambah stok (Masuk/Inbound)
            $barang->stok_aktual += $request->kuantitas;
        }

        // 4. Simpan perubahan stok ke tabel logistik
        $barang->save();

        // 5. Catat riwayat ke tabel transaksi
        TransaksiLogistik::create($request->all());

        // 6. Kembali ke halaman riwayat dengan pesan sukses
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dicatat dan stok SOH telah diperbarui otomatis!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
