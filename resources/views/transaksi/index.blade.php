@extends('layouts.app')

@section('title', 'Buku Mutasi Barang | Si Bungas')

@section('breadcrumb')
    <span class="text-slate-800 font-semibold">Mutasi Stok (Transaksi)</span>
@endsection

@section('content')
    @if(session('success'))
    <div class="mb-6 p-4 rounded-lg bg-emerald-50 border border-emerald-200 flex items-center gap-3 animate-slide-up">
        <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 flex-shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </div>
        <p class="text-sm font-medium text-emerald-800">{{ session('success') }}</p>
    </div>
    @endif

    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Buku Mutasi Barang</h2>
            <p class="text-sm text-slate-500 mt-1.5">Riwayat penerimaan vendor dan penggunaan sparepart di lapangan.</p>
        </div>
        <a href="{{ route('transaksi.create') }}" class="inline-flex items-center justify-center bg-red-600 hover:bg-red-700 text-white text-sm font-semibold py-2.5 px-5 rounded-lg shadow-md shadow-red-600/20 transition-all transform hover:-translate-y-0.5">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Catat Transaksi Baru
        </a>
    </div>

    <div class="bg-white border border-slate-200 rounded-xl shadow-sm flex flex-col animate-slide-up">
        <div class="overflow-x-auto custom-scrollbar relative">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="py-3.5 px-6 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Tanggal</th>
                        <th class="py-3.5 px-6 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Part Number</th>
                        <th class="py-3.5 px-6 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Deskripsi Barang</th>
                        <th class="py-3.5 px-6 text-[11px] font-bold text-slate-500 uppercase tracking-wider text-center">Jenis</th>
                        <th class="py-3.5 px-6 text-[11px] font-bold text-slate-500 uppercase tracking-wider text-right">Qty</th>
                        <th class="py-3.5 px-6 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($transaksi as $trx)
                    <tr class="hover:bg-slate-50/80 transition-colors group">
                        <td class="py-4 px-6 text-sm font-medium text-slate-600">
                            {{ \Carbon\Carbon::parse($trx->tanggal_transaksi)->format('d M Y') }}
                        </td>
                        <td class="py-4 px-6 text-sm font-mono font-bold text-slate-700">
                            {{ $trx->logistik->kode_barang ?? 'N/A' }}
                        </td>
                        <td class="py-4 px-6 text-sm font-medium text-slate-900">
                            {{ $trx->logistik->nama_barang ?? 'Barang Dihapus' }}
                        </td>
                        <td class="py-4 px-6 text-sm text-center">
                            @if($trx->jenis_transaksi == 'Masuk')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold bg-emerald-100 text-emerald-700 border border-emerald-200">
                                    &darr; INBOUND
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold bg-orange-100 text-orange-700 border border-orange-200">
                                    &uarr; OUTBOUND
                                </span>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-sm font-bold text-right {{ $trx->jenis_transaksi == 'Masuk' ? 'text-emerald-600' : 'text-orange-600' }}">
                            {{ $trx->jenis_transaksi == 'Masuk' ? '+' : '-' }}{{ number_format($trx->kuantitas, 0, ',', '.') }}
                        </td>
                        <td class="py-4 px-6 text-sm text-slate-500 truncate max-w-[200px]" title="{{ $trx->keterangan }}">
                            {{ $trx->keterangan ?? '-' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-16 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                                <h3 class="text-sm font-bold text-slate-700">Belum Ada Transaksi</h3>
                                <p class="mt-1 text-sm text-slate-500 max-w-sm">Riwayat mutasi barang akan muncul di sini. Klik "Catat Transaksi Baru" untuk memulai.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection