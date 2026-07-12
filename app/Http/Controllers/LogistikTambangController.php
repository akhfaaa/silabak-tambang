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

    public function index()
    {
        // Mengambil semua data logistik tambang dari database
        $data_logistik = LogistikTambang::all();
        
        // Mengarahkan ke file view 'index' di dalam folder 'logistik'
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
