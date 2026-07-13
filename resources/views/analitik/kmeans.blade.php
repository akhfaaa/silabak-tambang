@extends('layouts.app')

@section('title', 'Analitik K-Means | Si Bungas')

@section('breadcrumb')
    <span class="text-slate-800 font-semibold">Analisis K-Means</span>
@endsection

@section('content')
    @if(isset($error))
    <div class="max-w-4xl mx-auto py-16 text-center animate-slide-up">
        <div class="w-16 h-16 bg-red-50 text-red-600 rounded-full flex items-center justify-center mb-4 mx-auto border border-red-100 shadow-sm">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
        </div>
        <h3 class="text-lg font-bold text-slate-800">Kalkulasi Ditangguhkan</h3>
        <p class="text-slate-500 text-sm mt-2 max-w-md mx-auto">{{ $error }}</p>
        <a href="{{ route('transaksi.create') }}" class="mt-6 inline-flex items-center justify-center bg-red-600 hover:bg-red-700 text-white text-sm font-semibold py-2.5 px-5 rounded-lg shadow-sm transition-all">
            Catat Transaksi Keluar Baru
        </a>
    </div>
    @else

    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-6 animate-slide-up">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Segmentasi Pergerakan Barang</h2>
            <p class="text-sm text-slate-500 mt-1.5">Pengelompokan otomatis suku cadang tambang menggunakan pemrosesan data mutasi aktual.</p>
        </div>
        <div class="px-4 py-2 bg-slate-100 border border-slate-200 text-xs font-bold rounded-lg text-slate-600">
            Iterasi Konvergen: Genap {{ $iteration }} Kali
        </div>
    </div>

    <div class="bg-white border border-slate-200 rounded-xl shadow-sm flex flex-col animate-slide-up" style="animation-delay: 0.1s;">
        <div class="overflow-x-auto custom-scrollbar">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="py-4 px-6 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Part Number</th>
                        <th class="py-4 px-6 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Deskripsi Barang</th>
                        <th class="py-4 px-6 text-[11px] font-bold text-slate-500 uppercase tracking-wider text-right">Volume Keluar (Qty)</th>
                        <th class="py-4 px-6 text-[11px] font-bold text-slate-500 uppercase tracking-wider text-right">Frekuensi Keluar</th>
                        <th class="py-4 px-6 text-[11px] font-bold text-slate-500 uppercase tracking-wider text-center">Klaster Hasil Analisis</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($dataset as $data)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="py-4 px-6 text-sm font-mono font-bold text-slate-700">{{ $data['kode_barang'] }}</td>
                        <td class="py-4 px-6 text-sm font-medium text-slate-900">{{ $data['nama_barang'] }}</td>
                        <td class="py-4 px-6 text-sm font-semibold text-right text-slate-600">{{ number_format($data['x'], 0, ',', '.') }}</td>
                        <td class="py-4 px-6 text-sm font-semibold text-right text-slate-600">{{ $data['y'] }} Kali</td>
                        <td class="py-4 px-6 text-sm text-center">
                            @if($data['label_cluster'] == 'Fast Moving')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-50 text-red-700 ring-1 ring-inset ring-red-600/20">
                                    🚀 {{ $data['label_cluster'] }}
                                </span>
                            @elseif($data['label_cluster'] == 'Medium Moving')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 ring-1 ring-inset ring-blue-600/20">
                                    📦 {{ $data['label_cluster'] }}
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-slate-50 text-slate-600 ring-1 ring-inset ring-slate-500/10">
                                    ⏳ {{ $data['label_cluster'] }}
                                </span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
@endsection