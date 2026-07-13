@extends('layouts.app')

@section('title', 'Catat Transaksi Baru | Si Bungas')

@section('breadcrumb')
    <a href="{{ route('transaksi.index') }}" class="text-slate-400 hover:text-red-600 transition-colors">Mutasi Stok</a>
    <svg class="w-4 h-4 mx-2 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
    <span class="text-slate-800 font-semibold">Catat Transaksi</span>
@endsection

@section('content')
    @if(session('error'))
    <div class="mb-6 max-w-4xl mx-auto p-4 rounded-lg bg-red-50 border border-red-200 flex items-center gap-3 animate-slide-up">
        <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center text-red-600 flex-shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <p class="text-sm font-bold text-red-800">{{ session('error') }}</p>
    </div>
    @endif

    <div class="max-w-4xl mx-auto animate-slide-up">
        <div class="mb-6">
            <a href="{{ route('transaksi.index') }}" class="text-sm font-medium text-slate-500 hover:text-red-600 transition-colors inline-flex items-center mb-4">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Tabel Riwayat
            </a>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Formulir Mutasi Barang</h2>
            <p class="text-slate-500 mt-1.5 text-sm">Pilih barang yang ingin dikeluarkan (Outbound) atau dimasukkan (Inbound).</p>
        </div>

        <div class="bg-white border border-slate-200 rounded-xl shadow-sm">
            <div class="p-6 border-b border-slate-100 bg-slate-50/50 rounded-t-xl">
                <h3 class="text-sm font-bold text-slate-800">Rincian Mutasi</h3>
            </div>
            
            <form action="{{ route('transaksi.store') }}" method="POST" class="p-6 md:p-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                    
                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 mb-2 uppercase tracking-wide">Pilih Barang (Part Number) <span class="text-red-500">*</span></label>
                        <select name="logistik_tambang_id" class="w-full px-4 py-3 bg-slate-50 rounded-lg border border-slate-200 focus:bg-white focus:ring-2 focus:ring-red-500/20 focus:border-red-500 outline-none transition-all text-sm font-medium" required>
                            <option value="" disabled selected>-- Pilih Barang dari Master Inventori --</option>
                            @foreach($barang as $item)
                                <option value="{{ $item->id }}">{{ $item->kode_barang }} - {{ $item->nama_barang }} (Stok Saat Ini: {{ $item->stok_aktual }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-2 uppercase tracking-wide">Jenis Transaksi <span class="text-red-500">*</span></label>
                        <div class="flex gap-4">
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="jenis_transaksi" value="Keluar" class="peer sr-only" required>
                                <div class="px-4 py-3 text-center rounded-lg border border-slate-200 text-sm font-bold text-slate-500 hover:bg-slate-50 peer-checked:border-orange-500 peer-checked:bg-orange-50 peer-checked:text-orange-700 transition-all">
                                    &uarr; KELUAR (Outbound)
                                </div>
                            </label>
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="jenis_transaksi" value="Masuk" class="peer sr-only" required>
                                <div class="px-4 py-3 text-center rounded-lg border border-slate-200 text-sm font-bold text-slate-500 hover:bg-slate-50 peer-checked:border-emerald-500 peer-checked:bg-emerald-50 peer-checked:text-emerald-700 transition-all">
                                    &darr; MASUK (Inbound)
                                </div>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-2 uppercase tracking-wide">Kuantitas (Qty) <span class="text-red-500">*</span></label>
                        <input type="number" name="kuantitas" min="1" class="w-full px-4 py-3 bg-slate-50 rounded-lg border border-slate-200 focus:bg-white focus:ring-2 focus:ring-red-500/20 focus:border-red-500 outline-none transition-all text-sm font-bold" placeholder="0" required>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-2 uppercase tracking-wide">Tanggal Transaksi <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_transaksi" value="{{ date('Y-m-d') }}" class="w-full px-4 py-3 bg-slate-50 rounded-lg border border-slate-200 focus:bg-white focus:ring-2 focus:ring-red-500/20 focus:border-red-500 outline-none transition-all text-sm" required>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-2 uppercase tracking-wide">Keterangan / Tujuan (Opsional)</label>
                        <input type="text" name="keterangan" class="w-full px-4 py-3 bg-slate-50 rounded-lg border border-slate-200 focus:bg-white focus:ring-2 focus:ring-red-500/20 focus:border-red-500 outline-none transition-all text-sm" placeholder="Contoh: Unit HD785-04 atau Vendor A">
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-slate-100 flex justify-end gap-3">
                    <a href="{{ route('transaksi.index') }}" class="px-6 py-3 rounded-lg font-semibold text-slate-600 hover:bg-slate-100 transition-colors text-sm">Batal</a>
                    <button type="submit" class="px-8 py-3 rounded-lg font-bold text-white bg-red-600 hover:bg-red-700 shadow-md shadow-red-600/20 transition-all text-sm transform hover:-translate-y-0.5">
                        Simpan Transaksi & Update Stok
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection