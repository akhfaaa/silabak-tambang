<?php

namespace App\Http\Controllers;
use App\Models\LogistikTambang;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class LogistikTambangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     //
    //     $data_logistik = LogistikTambang::all();

    //     return view('logistik.index', compact('data_logitik'));
    // }

    public function index(Request $request)
    {
        // Menangkap kata kunci pencarian jika ada
        $search = $request->input('search');

        // Menjalankan kueri ke database
        $query = LogistikTambang::query();

        if ($search) {
            // Memfilter berdasarkan Part Number ATAU Deskripsi Barang
            $query->where('kode_barang', 'LIKE', "%{$search}%")
                  ->orWhere('nama_barang', 'LIKE', "%{$search}%");
        }

        // Mengambil data (bisa ditambahkan paginate() nanti jika data sudah ribuan)
        $data_logistik = $query->get();
        
        // Mengarahkan ke file view dengan membawa data logistik
        return view('logistik.index', compact('data_logistik'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('logistik.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // 1. Validasi data yang masuk dari form
        $request->validate([
            'kode_barang'  => 'required|unique:logistik_tambangs',
            'nama_barang'  => 'required',
            'kategori'     => 'required',
            'harga_beli'   => 'required|numeric',
            'stok_aktual'  => 'required|numeric',
            'stok_minimum' => 'required|numeric',
        ]);

        // 2. Simpan ke database
        LogistikTambang::create($request->all());

        // 3. Arahkan kembali ke halaman index
        return redirect()->route('logistik.index');
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
        $logistik = LogistikTambang::findOrFail($id);
        return view('logistik.edit', compact('logistik'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        // 1. Validasi data (Pengecualian unique untuk kode_barang milik ID ini sendiri)
        $request->validate([
            'kode_barang'  => 'required|unique:logistik_tambangs,kode_barang,'.$id,
            'nama_barang'  => 'required',
            'kategori'     => 'required',
            'harga_beli'   => 'required|numeric',
            'stok_aktual'  => 'required|numeric',
            'stok_minimum' => 'required|numeric',
        ]);

        // 2. Cari data dan perbarui
        $logistik = LogistikTambang::findOrFail($id);
        $logistik->update($request->all());

        // 3. Kembali ke halaman utama
        return redirect()->route('logistik.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $logistik = LogistikTambang::findOrFail($id);
        $logistik->delete();

        return redirect()->route('logistik.index');
    }
}

